<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class BookshelfController extends Controller
{
    public function index(Request $request)
    {
        if ($this->isMobile($request)) {
            return redirect()->away(env('URL_MOBILE_VIEW') . '/bookshelf');
        }

        return view('courses.bookshelf');
    }

    protected function isMobile(Request $request): bool
    {
        $userAgent = $request->header('User-Agent');
        $mobileAgents = [
            'Mobile', 'Android', 'Silk/', 'Kindle', 'BlackBerry', 'Opera Mini', 'Opera Mobi', 'iPhone', 'iPad'
        ];

        foreach ($mobileAgents as $agent) {
            if (stripos($userAgent, $agent) !== false) {
                return true;
            }
        }

        return false;
    }

    public function all()
    {
        $books = DB::table('bookshelves')->where('visible',1)->get();
        return view('courses.book_lets.all', compact('books'));
    }
}
