<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveSite
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Admin request (header based)
        if ($request->hasHeader('X-Site-ID')) {
            $site = Site::find($request->header('X-Site-ID'));
        } 
        // Public website (domain based)
        else {
            $site = Site::where('domain', $request->getHost())->first();
        }
    
        if (!$site) {
            return response()->json(['message' => 'Site not found'], 404);
        }
    
        app()->instance('currentSite', $site);
    
        return $next($request); // Admin request (header based)
        if ($request->hasHeader('X-Site-ID')) {
            $site = Site::find($request->header('X-Site-ID'));
        } 
        // Public website (domain based)
        else {
            $site = Site::where('domain', $request->getHost())->first();
        }
    
        if (!$site) {
            return response()->json(['message' => 'Site not found'], 404);
        }
    
        app()->instance('currentSite', $site);
    
        return $next($request);
    }
}
