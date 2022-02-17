<?php

namespace App\Http\Middleware;

use Closure;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->method() === 'GET') {
            $segment = $request->segment(1);
            if($segment === null || in_array($segment, config('app.available_locales'))) {
              session(['locale' => $segment]);
              app()->setLocale($segment);
            }
        }

        return $next($request);
    }
}
