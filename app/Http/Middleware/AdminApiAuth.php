<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AdminToken;

class AdminApiAuth
{
    public function handle(Request $request, Closure $next)
    {
        $admin = session('admin');

        if (!$admin || !isset($admin['token'])) {
            Session::forget('admin');
            return redirect('/admin/login')->withErrors(['Unauthorized Access!']);
        }

        $token = $admin['token'];
        if (!AdminToken::where('token', $token)->exists()) {
            return redirect('/admin/login')->withErrors(['Unauthorized Access!']);
        }

        return $next($request);
    }
}
