<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::group(['as' => 'cla.', 'middleware' => ['web', 'guest'], 'prefix' => 'clientarea'], function () {
    Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
    Route::post('/register', [RegisterController::class, 'doRegister'])->name('register.do');
    Route::post('/register/done', [RegisterController::class, 'finishRegister'])->name('register.finish');

    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'doLogin'])->name('login.do');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgot'])->name('forgotpass');
    Route::post('/send-reset-link', [ForgotPasswordController::class, 'sendLink'])->name('forgot.do');
    Route::post('/password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');

    Route::get('/verify', [RegisterController::class, 'verify'])->name('verify');

    Route::get('/logout', function () {
        \DB::table('user_access_tokens')->where('user_id', auth()->user()->id)->delete();
        \Auth::logout(auth()->user());
        \Alert::warning('Success', 'Please login again in order to continue...');
        return redirect()->route('cla.login');
    })->name('logout');

    Route::get('/start-from-scratch', function () {
        Session::forget('emailVerified');
        return redirect()->route('cla.register');
    })->name('scratchy');
});
