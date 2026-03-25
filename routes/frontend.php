<?php
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Front\Pages\LandingController;
use App\Http\Controllers\Front\Pages\WebPageController;
use App\Http\Controllers\Pages\ContactBoxController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\Etc\SubscribeController;
use App\Http\Controllers\Pages\SurveyController;
use App\Http\Controllers\Pages\RepresentativeController;

Route::group(['as' => 'frt.', 'middleware' => ['web']], function () {
    Route::post('/telegram/webhook', [TelegramController::class, 'webhook']);

    Route::get('courses/courses/sample-questions', function(){
        return redirect('courses/sample-questions');
    });

    // In routes/web.php
    Route::get('/test-telegram/{username}', [SurveyController::class, 'testTelegramMessage']);

    Route::get('/complete_registration', [SurveyController::class, 'show'])->name('survey.reg.show');
    Route::post('/complete_registration/submit', [SurveyController::class, 'submit'])->name('survey.reg.submit');

    // web.php
    Route::get('user-image/{folder}/{userId}/{filename}', function ($folder, $userId, $filename) {
        // Security: only allow 'users' or 'members' folders
        if (!in_array($folder, ['users', 'members'])) {
            abort(404);
        }

        $path = storage_path("app/private/public/{$folder}/{$userId}/{$filename}");

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        return response($file, 200)->header('Content-Type', $type);
    });


//    Route::get('/test-mail', function () {
//        $body = "Hello,\n\nThis is a test.\nHere is a second line.\n\nThank you.";
//
//        Mail::raw($body, function ($message) {
//            $message->to('vagefipouya@yahoo.com')
//                ->subject('Test Plain Text Email');
//        });
//
//        return 'Sent!';
//    });

    Route::get('/logout', function () {
        \Auth::logout(auth()->user());
        return redirect('/');
    });

    Route::get('/register', fn() => redirect('/clientarea/register'));
    Route::get('/login', fn() => redirect('/clientarea/login'))->name('login');
//    Route::get('/admin/login', fn() => redirect()->to(env('URL_ADMIN')));

    Route::post('/submit/contact', [ContactBoxController::class, 'submit'])->name('contact.submit');
    Route::post('/new-subscriber', [SubscribeController::class, 'newSubcribe'])->name('new.sub');
    Route::post('/new-representative', [RepresentativeController::class, 'newRep'])->name('new.rep');

    $webPages = DB::table('web_pages')->get();
    foreach ($webPages as $page) {
        if ($page->title !== 'Homepage') {
            Route::get('/{slug}', [WebPageController::class, 'show'])->name($page->route_name);
        } else {
            Route::get($page->slug, [LandingController::class, $page->route_name])->name('index');
        }
    }

    $membersPage = \App\Models\MemberCountry::all();

    foreach ($membersPage as $mc) {
        $slug = pathinfo($mc->flag, PATHINFO_FILENAME);
        $routeName = "members.country." . $slug;

        Route::get('/members/' . $slug, function () use ($mc, $slug) {
            $searchFor = ucfirst(strtolower($slug));
            $members = \App\Models\Member::where('country',$searchFor)->get();

            return view('pages.member_country', ['member_country' => $mc, 'members' => $members]);
        })->name($routeName);
    }

    Route::fallback(fn() => abort(404));

    Route::get('/private-survey-images/{folder}/{type}/{filename}', function ($folder, $type, $filename) {
        // Validate type is either 'id' or 'avatar'
        if (!in_array($type, ['id', 'avatar'])) {
            abort(404);
        }

        $path = storage_path("app/private/survey/completedReg/{$folder}/{$type}/{$filename}");

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    })->name('private.survey.images');

    Route::get('courses/courses/all',function(){
        return redirect('courses/all');
    });

    Route::get('clientarea/courses/all',function(){
        return redirect('courses/all');
    });

    Route::get('/clientarea/courses/sample-questions', function(){
        return redirect('courses/sample-questions');
    });

});
