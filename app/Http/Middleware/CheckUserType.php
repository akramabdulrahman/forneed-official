<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Flash;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$userType)
    {

        $user = Auth::user();
        if ($user->isServiceProvider()) {
            if (in_array('serviceProvider', $userType))
                return $next($request);

            if ($user->hasRole('admin')) {
                if (in_array('admin', $userType))
                    return $next($request);

                return redirect()->back();
            }
            return redirect()->back();
        } else if ($user->isCitizen()) {
            if (in_array('citizen', $userType))
                return $next($request);

            if ($user->hasRole('admin')) {

                if (in_array('admin', $userType))
                    return $next($request);

                return redirect()->back();
            }
            return redirect()->back();
        } else if ($user->isWorker()) {
            if (in_array('worker', $userType))
                return $next($request);

            if ($user->hasRole('admin')) {

                if (in_array('admin', $userType))
                    return $next($request);

                return redirect()->back();
            }
            return redirect()->back();
        } else if ($user->hasRole('admin')) {

            if (in_array('admin', $userType))
                return $next($request);

            return redirect()->back();
        }


        return redirect('/checkpoint');

        // return $next($request);

//        return response('Unauthorized.', 401);
    }
}
