<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserRegistrationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\RegisterUserRequest;
use Session;
use App\Models\User;
use Hash;
use Auth;
class RegisterController extends Controller
{
    protected $userRegistrationService;

    /**
     * Handle the incoming request.
     */

    public function __construct(UserRegistrationService $userRegistrationService)
    {
        $this->userRegistrationService = $userRegistrationService;
    }

    public function doRegister(Request $request)
    {
        return $this->userRegistrationService->doRegister($request);
    }

    public function showRegister(Request $request)
    {
        if ($request->session()->has('emailVerified')) {
            $request->session()->reflash();
        }

        return view('clientarea.register');
    }

    public function verify(Request $request)
    {
        $email = $request->query('email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('cla.register')->with('error', 'Invalid verification link.');
        }

        $user->email_verified_at = now();
        $user->is_active = 1;
        $user->save();

        Session::put('emailVerified',$user->email);

        return redirect()->route('cla.register')->with('success', 'Your email has been activated successfully! Please login to your account.');
    }
    public function finishRegister(Request $request)
    {
        $validatedData = $request->validate([
            'user_id'         => 'required|exists:users,id',
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'passport_number' => 'required|string|min:6|max:9|regex:/^[A-Za-z0-9]+$/|unique:members,passport_number',
            'country'         => 'required|string|max:100',
            'agent_name'      => 'nullable|string|max:255',
            'agent_code'      => 'nullable|string|max:50',
            'photo'           => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'passport_photo'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $passportNumber = $request->passport_number;

        $findUser = User::find($validatedData['user_id']);

        if (strlen($passportNumber) > 9) {
            return redirect()->back()->withErrors('Passport number is too long.');
        }

        do {
            $personalCode = Str::uuid();
        } while (DB::table('members')->where('personal_code', $personalCode)->exists());

        $countryName = ucfirst(strtolower($validatedData['country']));

        $countryExists = DB::table('members_country')->whereRaw('LOWER(name) = ?', [strtolower($countryName)])->exists();
        if (!$countryExists) {
            DB::table('members_country')->insert([
                'name'       => $countryName,
                'flag'       => null,
                'c_link'     => null,
                'pinned'     => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $storagePath = "members/{$validatedData['user_id']}/";

        $passportPhotoPath = $request->file('passport_photo')->store($storagePath, 'private');
        $avatarPath = $request->file('photo')->store($storagePath, 'private');

        DB::table('members')
            ->where('user_id', $validatedData['user_id'])
            ->delete();

        DB::table('members')->insert([
            'user_id'         => $validatedData['user_id'],
            'surname'         => $validatedData['last_name'],
            'father_name'     => $validatedData['first_name'],
            'passport_number' => $validatedData['passport_number'],
            'country'         => $countryName,
            'agent_name'      => $validatedData['agent_name'] ?? null,
            'agent_code'      => $validatedData['agent_code'] ?? null,
            'passport_photo'  => $passportPhotoPath,
            'personal_code'   => $personalCode,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        do {
            $rawToken = Str::random(60);
            $hashedToken = hash('sha256', $rawToken);
        } while (DB::table('user_access_tokens')->where('token', $hashedToken)->exists());

        DB::table('user_access_tokens')->insert([
            'user_id'    => $validatedData['user_id'],
            'token'      => $hashedToken,
            'expires_at' => now()->addDays(30),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $findUser->is_active = 1;
        $findUser->last_login = now();
        $findUser->save();

        Auth::login($findUser);

        Session::forget('emailVerified');

        return redirect()->away(env('URL_PANEL') . '?' . http_build_query(['auth_token' => $hashedToken]));
    }

}
