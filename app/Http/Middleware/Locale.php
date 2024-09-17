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


            $locale = 'en';

            $segment = $request->segment(1);

            if ($segment == 'ua') $locale = $segment;

            session(['locale' => $locale]);
            app()->setLocale($locale);

            // redirect routes
            $segments = $request->segments();
            if ($locale == 'ua') unset($segments[0]);
            $url = '/'.implode('/', $segments);
            $base_url = $request->root();

            // trailing slash
            if ( $request->getRequestUri() != '/' &&
                 !preg_match('/.+\/$/', $request->getRequestUri()) &&
                 strpos($request->getRequestUri(), '?') === false
                )
            {
                return redirect($base_url.$request->getRequestUri().'/', 301);
            }
        }

        view()->share('locale', app()->getLocale());

        return $next($request);
    }
}
