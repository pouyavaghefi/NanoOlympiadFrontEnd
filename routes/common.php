<?php

use Illuminate\Support\Facades\Route;

Route::get('/reset/{token}', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetForm'])->name('password.reset');

Route::get('/courses',function(){
    return redirect()->route('frt.crs.index');
});

Route::get('captcha', function() {
    $builder = new Gregwar\Captcha\CaptchaBuilder;
    $builder->build();
    session()->put('captcha', $builder->getPhrase());
    return response($builder->output())->header('Content-Type', 'image/jpeg');
});

Route::get('undefined', function(){
    return redirect('/members/ir');
});

Route::get('/{any1}/courses/course-player/{any2}', function ($any1, $any2) {
    return redirect('https://nanolympiad.org/courses/course-player/' . $any2);
})->where(['any1' => '.*', 'any2' => '.*']);

