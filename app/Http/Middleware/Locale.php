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

            $locale = 'ua';
            if ($segment == 'en') $locale = $segment;

            session(['locale' => $locale]);
            app()->setLocale($locale);

            // trailing slash
            if ( $request->getRequestUri() != '/' &&
                 !preg_match('/.+\/$/', $request->getRequestUri()) &&
                 strpos($request->getRequestUri(), '?') === false
                )
            {
                return redirect($request->root().$request->getRequestUri().'/', 301);
            }
        }

        return $next($request);
    }
}
