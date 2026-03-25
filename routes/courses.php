<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Front\Pages\CourseController;
use App\Http\Controllers\Front\Pages\EpisodeController;
use App\Http\Controllers\Pages\CoursePlayerController;
use App\Http\Controllers\Pages\BookshelfController;
use App\Http\Controllers\Pages\BookLetController;
use App\Http\Controllers\Pages\SampleQuestionController;

Route::group(['as' => 'frt.', 'middleware' => ['web']], function () {
    Route::group(['as' => 'crs.', 'prefix' => 'courses'], function () {
        Route::get('/course-player/Coming Soon!', function () {
            return redirect('/courses/all');
        });

        Route::get('/book-lets/courses/all', function () {
            return redirect('/courses/all');
        });

        Route::get('bookshelf', [BookshelfController::class,'index'])->name('bookshelf');
        Route::get('book-lets', [BookshelfController::class,'all'])->name('booklets');

        Route::get('/book-lets/{slug}', [BookLetController::class, 'index'])->name('books.index');
        Route::get('/sample-questions', [SampleQuestionController::class, 'index'])->name('mocks.index');

        Route::get('/all', [CourseController::class, 'index'])->name('index');
        Route::get('/{slug}', [CourseController::class, 'showCourse'])->name('show');
        Route::get('/enroll/{id}', [CourseController::class, 'enroll'])->name('enrollNow');
        Route::post('/add-to-wishlist/{id}', [CourseController::class, 'addToWishList'])->name('addToWishList');

        Route::group(['as' => 'epi.', 'prefix' => 'episodes'], function () {
            Route::get('/', [EpisodeController::class, 'index'])->name('index');
            Route::get('/{slug}', [EpisodeController::class, 'showEpisode'])->name('show');

            Route::post('/{id}/like', [EpisodeController::class, 'like'])->name('like');
            Route::post('/{id}/dislike', [EpisodeController::class, 'dislike'])->name('dislike');

            Route::post('/{episodeSlug}/report-bug', [EpisodeController::class, 'reportBug'])->name('reportBug');
        });

        Route::get('/course-player/{slug}',[CoursePlayerController::class,'showCourseEpisodes'])->name('course_player.index');
        Route::get('/course-player/{slug}/{epi?}',[CoursePlayerController::class,'showCourseNextEpisode'])->name('course_player.index.rest');
    });
});

Route::get('/members/courses/course-player/{slug}', function ($slug) {
    return redirect("/courses/course-player/{$slug}", 301);
});
