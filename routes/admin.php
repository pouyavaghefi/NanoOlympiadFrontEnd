<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;

Route::group(['as' => 'adm.', 'middleware' => ['web'], 'prefix' => 'admin'], function () {

    Route::get('login', function () {
        if(Session::has('admin_token')){
            Session::forget('admin_token');
            Session::forget('admin_email');
        }
        return view('admin.login.login');
    })->name('login')->middleware('guest.admin');

    Route::post('login', [LoginController::class, 'login'])->name('login.do');
    Route::get('verify', [LoginController::class, 'showVerify'])->name('login.verify');
    Route::post('verify', [LoginController::class, 'doVerify']);

    Route::group([
        'as' => 'panel.',
        'prefix' => 'panel',
        'middleware' => ['admin.auth']
    ], function () {
        Route::get('/', function () {
            return 'panel';
        })->name('index');
    });
});
