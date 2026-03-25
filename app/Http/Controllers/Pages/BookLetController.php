<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookshelf;
class BookLetController extends Controller
{
    public function index(Request $request, $slug)
    {
        $bookletNumber = (int) preg_replace('/[^0-9]/', '', $slug);

        $pdf = Bookshelf::where('slug', 'like', "%booklet-{$bookletNumber}%")->first();

        if (!$pdf) {
            abort(404, 'Booklet not found');
        }

        $viewName = "courses.book_lets.index_one";
        if ($bookletNumber === 1) {
            if ($this->isMobile($request)) {
                return redirect()->away(env('URL_MOBILE_VIEW') . '/book-lets/booklet-1');
            }

            $viewName = "courses.book_lets.index_one";
        } elseif ($bookletNumber === 2) {
            if ($this->isMobile($request)) {
                return redirect()->away(env('URL_MOBILE_VIEW') . '/book-lets/booklet-2');
            }

            $viewName = "courses.book_lets.index_two";
        }else{
            dd("Wrong way bro!");
        }

        return view($viewName, [
            'pdf' => $pdf,
            'slug' => $slug,
            'bookletNumber' => $bookletNumber
        ]);
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

    public function booklets()
    {
        return view('courses.book_lets.booklets');
    }
}
