<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPurchase
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
        $userRoles = Auth::user()->roles->pluck('name');
        //dd($userRoles);

        if(!$userRoles->contains('purchase')){
            return redirect('/home');
        }

        return $next($request);
    }
}
