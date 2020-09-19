<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard('admin')->check()) {
            if (Str::contains($request->route()->action['as'], 'admin') and !$request->route() == 'logout') {
                return redirect(config('app.admin_prefix') . '/transaction');
            }
        }

        return $next($request);
    }
}
