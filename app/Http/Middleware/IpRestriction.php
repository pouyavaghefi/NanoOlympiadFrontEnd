<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterUserRequest;
class IpRestriction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // $siteComingSoon = DB::table('base_infos')
        //     ->where('type', 'siteComingSoon')
        //     ->value('value');

        // if ($siteComingSoon === 'show') {
        //     $allowedIps = DB::table('ip_restrictions')->pluck('ip_address')->toArray();

        //     if (!in_array($request->ip(), $allowedIps)) {
        //         \Log::info('Client IP Address: ' . $request->ip());
        //         $static = DB::table('static_pages')->where('type', 'coming_soon')->get();

        //         return response()->view('temp.coming.index', compact('static'));
        //     }
        // }

        return $next($request);
    }
}
