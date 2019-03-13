<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;

class ChooseCategoryMiddleware
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
        if ($request->user()->user_type && count($request->user()->categories) < 1){

            notify()->error("You have not added any Category","No Category");

            return redirect()->route('creator.categories');

        }

        return $next($request);
    }
}
