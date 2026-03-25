<?php
require __DIR__.'/common.php';
require __DIR__.'/frontend.php';
require __DIR__.'/courses.php';
require __DIR__.'/clientarea_guest.php';
require __DIR__.'/clientarea_auth.php';
require __DIR__.'/admin.php';

// Quick one-off test/demo route
//Route::get('/show-alert', function () {
//    return view('temp.redirection.show-alert');
//})->name('show.alert');

// Fallback (optional: move to a fallback.php route file if preferred)
Route::fallback(function () {
    abort(404);
});

