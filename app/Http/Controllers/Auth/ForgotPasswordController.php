<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
class ForgotPasswordController extends Controller
{
    public function showForgot()
    {
        return view('clientarea.forgot');
    }

    public function sendLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', __('A password reset link has been sent to your email.'))
            : back()->withErrors(['email' => __('Unable to send reset link. Please try again.')]);
    }

    public function showResetForm($token)
    {
        return view('clientarea.reset', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|string|confirmed',
            'token' => 'required',
            'email' => 'required|email',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('cla.login')->with('success', __('Your password has been reset.'))
            : back()->withErrors(['email' => __('Invalid reset token or email.')]);
    }
}
