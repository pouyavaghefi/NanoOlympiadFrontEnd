<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class GuestAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
//        if ($request->session()->has('admin')) {
//            return redirect()->route('adm.panel.index');
//        }

        $admin = session('admin');

        if (!$admin || !isset($admin['token'])) {
            return $next($request);
        }else{
            Session::forget('admin');
            return redirect()->route('adm.panel.index');
        }

        $token = $admin['token'];
        if (!AdminToken::where('token', $token)->exists()) {
            Session::forget('admin');
            return $next($request);
        }else{
            return redirect()->route('adm.panel.index');
        }
    }
}
