<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AssignAuthId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $authId = $request->cookie('auth_id');

        if (!$authId) {
            $authId = Str::uuid()->toString();
            $response = $next($request);
            return $response->withCookie(cookie('auth_id', $authId, 60 * 24 * 30));
        }

        return $next($request);
    }
}
