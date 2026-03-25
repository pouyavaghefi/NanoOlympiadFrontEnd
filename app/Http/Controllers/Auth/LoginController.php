<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAccessToken;
use Session;
use Mail;
use App\Mail\RegistrationEmail;
use App\Notifications\NewUserNotification;
use App\Models\User;
use App\Events\UserRegistered;
class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function showLogin()
    {
        return view('clientarea.login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $user = User::where('email',$request->email)->first();

        if($user) {
            if (($user->is_active == 1) AND (!is_null($user->email_verified_at))) {
                Auth::login($user);

                if (auth()->check()) {
                    $user = Auth::user();

                    $user->last_login = date('Y-m-d H:i:s');
                    $user->save();

                    $token = bin2hex(random_bytes(32));

                    $expiresAt = now()->addMinutes(60);

                    $existingToken = UserAccessToken::where('user_id', $user->id)->first();

                    if ($existingToken) {
                        $existingToken->delete();
                    }

                    DB::table('user_access_tokens')->insert([
                        'user_id' => $user->id,
                        'token' => $token,
                        'expires_at' => $expiresAt,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $panelUrl = env('URL_PANEL');

                    return redirect()->to("{$panelUrl}?auth_token=" . urlencode($token));
                }

                return redirect('/');
            } else {
                Mail::to($user->email)->send(new RegistrationEmail($user));

                return redirect()->back()->withSuccess('Please check your email to activate your account');
            }
        }else{
            return redirect()->back()->withErrors('User not found');
        }
    }
}
