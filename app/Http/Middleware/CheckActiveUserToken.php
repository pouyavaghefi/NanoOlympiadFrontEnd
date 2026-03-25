<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckActiveUserToken
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;

            $activeToken = DB::table('user_access_tokens')
                ->where('user_id', $userId)
                ->where('expires_at', '>', Carbon::now())
                ->first();

            if ($activeToken) {
                return redirect()->to(env('URL_PANEL'));
            }
        }

        return $next($request);
    }
}