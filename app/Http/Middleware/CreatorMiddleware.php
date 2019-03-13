<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CreatorMiddleware
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
        if (!$request->user()->user_type ==  config('studentbox.user_type.agent')){

            notify()->error("You don't have permission to enter this location","Permission denied");

            Auth::logout();

            return redirect('/');

        }
        return $next($request);
    }
}
