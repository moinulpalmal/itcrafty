<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckServicePerson
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
        $userRoles = Auth::user()->tasks->pluck('name');
        //dd($userRoles);

        if(!$userRoles->contains('service_person')){
            return redirect('/home');
        }

        return $next($request);
    }
}
