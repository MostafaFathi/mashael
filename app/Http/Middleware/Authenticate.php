<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('site::login');
        }
    }


    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        if(auth()->check() and auth()->user()->status != "Active"){
            if (! $request->expectsJson()) {
                return redirect()->route('site::home')->withErrors(['disabledAccount'=>'Acount is not active']);
            }
        }
        return $next($request);
    }

}
