<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Events\UserRegistered;
use App\Mail\RegistrationEmail;
use Illuminate\Support\Facades\Session;
use Mail;
use Alert;
use Str;
class UserRegistrationService
{
    public function doRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|same:password',
            'gender' => 'required|in:male,female',
            'country' => 'required',
            'mobile' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        if (!$this->checkPasswordStrength($request->password)) {
            return redirect()->route('cla.register')->with('error', 'Password does not meet the required strength');
        }

        $emailExists = User::where('email',$request->email)->first();
        if($emailExists){
            if($emailExists->email_verified_at == NULL){
                Mail::to($emailExists->email)->send(new RegistrationEmail($emailExists));

                return redirect()->route('cla.register')->with('success', 'Email was sent, please complete the registration (check the spam/junk folder as well).');
            }else{
                if($emailExists->is_active == 1){
                    Alert::success('Welcome Back!', '🔥 You Already Registered');

                    Auth::login($emailExists);

                    return redirect()->away(env('URL_PANEL'));
                }else{
                    Session::put('emailVerified',$emailExists->email);

                    return redirect()->route('cla.register')->with('error', 'Your email had been activated! Please continue and fill out these information... ');
                }
            }
        }else{
            $fullName = $request->name;
            list($fname, $lname) = $this->splitFullName($fullName);

            $userId = DB::table('users')->insertGetId([
                'fname' => $fname,
                'lname' => $lname,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => Hash::make($request->password),
            ]);

            $user = User::find($userId);

            DB::table('user_notifications')->insert([
                'user_id' => $user->id,
                'title' => "Welcome to user panel",
                'message' => "This is your first login into your dashboard...",
                'type' => "system"
            ]);

            DB::table('members')->insert([
                'user_id'           => $userId,
                'surname'           => $lname,
                'gender'            => $request->input('gender'),
                'country'           => $request->input('country'),
                'phone'             => $request->input('mobile'),
                'passport_verified' => 1,
                'personal_code'     => strtoupper(Str::random(10)),
                'created_at'        => now(),
                'updated_at'        => now()
            ]);


            Mail::to($user->email)->send(new RegistrationEmail($user));

            return redirect()->route('cla.register')->with('success', 'Email was sent, please complete the registration (check the spam/junk folder as well).');
        }
    }

    private function checkPasswordStrength($password): bool
    {
        return strlen($password) >= 8;
    }

    private function splitFullName($fullName): array
    {
        $nameParts = explode(' ', $fullName, 2);
        return [
            $nameParts[0] ?? null,
            $nameParts[1] ?? null,
        ];
    }
}