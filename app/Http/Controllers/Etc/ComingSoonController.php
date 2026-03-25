<?php

namespace App\Http\Controllers\Etc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComingSoonController extends Controller
{
    public function comingSoon()
    {
        $static = DB::table('static_pages')->get();
        return view('temp.coming.index', compact('static'));
    }

}
