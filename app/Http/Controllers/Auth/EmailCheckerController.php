<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Log;

class EmailCheckerController extends Controller
{
    public function check(Request $request)
    {
        $email = $request->input('email');

        // Example check
        $exists = \App\Models\User::where('email', $email)->exists();

        return response()->json(['exists' => $exists]);
    }
}