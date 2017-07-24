<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class NoUserType
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

        $user = Auth::user();
        if($user->hasRole('admin')){
            return redirect()->route('Dashboard.landing');
        }
        if (!$user->isServiceProvider() ) {
            return $next($request);
        } else if (!$user->isCitizen()) {
            return $next($request);
        }else if (!$user->isWorker()) {
            return $next($request);
        }

        return redirect()->route('profile');
    }
}
