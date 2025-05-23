<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{ 
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == "web" && Auth::guard($guard)->check()) {
			
			return redirect('admin/dashboard');
        }
        if ($guard == "user" && Auth::guard($guard)->check()) {
            return redirect('/');
        }
            return $next($request);
    }

    /*public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }
		return $next($request);
    }*/
}
