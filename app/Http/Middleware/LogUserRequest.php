<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;
class LogUserRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $ipAddress = $request->ip();
        $uri = $request->getRequestUri();
        $requestData = $request->all();

        DB::table('user_logs')->insert([
            'ip_address' => $ipAddress,
            'uri' => $uri,
            'request_data' => json_encode($requestData),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $next($request);
    }
}
