<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        if ($request->user() === null) {
            return redirect('/');
        }
        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;

        app()->setLocale($request->user()->locale);

        if ($request->user()->hasAnyRole($roles) || !$roles) {
            if ($request->user()->active == 0) {
                // return redirect()->route('front.notActive');
                return redirect('/');
            }
            return $next($request);
        }
        return redirect('/');
    }
}
