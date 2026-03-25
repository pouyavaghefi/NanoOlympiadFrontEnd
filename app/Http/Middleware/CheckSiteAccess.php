<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckSiteAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        $siteVisibilityKey = ($host === 'ar.nanolympiad.org') ? 'arSiteVisibility' : 'siteVisibility';
        $sitePublicationKey = 'sitePublication';

        $siteVisibility = DB::table('base_infos')
            ->where('type', $siteVisibilityKey)
            ->value('value');

        $sitePublication = DB::table('base_infos')
            ->where('type', $sitePublicationKey)
            ->value('value');

        if ($siteVisibility === 'coming_soon' || $sitePublication === 'under_construction') {
            $clientIp = $request->ip();
            $isAllowed = DB::table('allowed_ip_exceptions')
                ->where('ip', $clientIp)
                ->where('domain',null)
                ->exists();

            if (!$isAllowed) {
                if ($siteVisibility === 'coming_soon') {
                    $static = DB::table('static_pages')->where('type', 'coming_soon')->get();
                    return response()->view('temp.coming.index', compact('static'));
                }
                if ($sitePublication === 'under_construction') {
                    return response()->view('temp.construction.index');
                }
            }
        }

        return $next($request);
    }
}
