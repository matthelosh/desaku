<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Symfony\Component\HttpFoundation\Response;

class VisitorTracker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $time = now();
        $ip_address = $request->ip();
        $user_agent = $request->userAgent();
        $position = Location::get($ip_address);
        $traffic = Visitor::where('ip_address', $ip_address)->first();
        if (!$request->user()) {
            $traffic = new Visitor([
                'ip_address' => $ip_address,
                'user_agent' => $user_agent,
                'visited_uri' => $request->getRequestUri(),
                'country' => $position ? $position->countryName : null,
            ]);
            $traffic->save();
        }

        return $next($request);
    }
}
