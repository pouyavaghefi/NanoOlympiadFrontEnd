<?php

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'cla.', 'middleware' => ['web', 'auth'], 'prefix' => 'clientarea'], function () {
    Route::get('/logout', function () {
        \DB::table('user_access_tokens')->where('user_id', auth()->user()->id)->delete();
        \Auth::logout(auth()->user());
        \Alert::warning('Token Expired', 'Please login again in order to continue...');
        return redirect()->route('cla.login');
    })->name('logout');


});
