<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
class SetLocaleBySubdomain
{
    public function handle($request, Closure $next)
    {
        $host = $request->getHost();

        if (str_starts_with($host, 'ar.')) {
            App::setLocale('ar');
        } else {
            App::setLocale('en');
        }

        return $next($request);
    }
}