<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAccount
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
        if (Auth::check() && !Auth::user()->status) {
            if (!$request->is("user"))
                return redirect(route('user.home'));
        }
        else {
            if (Auth::check() && !Auth::user()->address) {
                if (!$request->is("user/profile"))
                    return redirect(route('user.profile'));
            }
        }

        return $next($request);
    }
}
