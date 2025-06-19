<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLogin
{

    public function handle(Request $request, Closure $next)
    {
       $user = Auth::guard('user')->user();

       if (!$user) {
            return redirect('/');
        }
        return $next($request);
    }
}
