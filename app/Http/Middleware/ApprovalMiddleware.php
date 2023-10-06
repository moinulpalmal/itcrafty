<?php

namespace App\Http\Middleware;

use Closure;

class ApprovalMiddleware
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
        if(auth()->check()){
            if(!auth()->user()->approved){
                auth()->logout();
                return redirect()->route('login')->with('message', trans('Your account need admin approval to login!'));
            }
        }
        return $next($request);
    }
}
