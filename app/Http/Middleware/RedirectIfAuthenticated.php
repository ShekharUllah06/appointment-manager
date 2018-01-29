<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/doctor');
        }
//        $username   = $request->get('username');
//            if((Auth::guard($guard)->check()) && ((User::where('username', $username)->first()->userType) == 1)){
//                return redirect('/doctor');
//            }elseif((Auth::guard($guard)->check()) && (User::where('username', $username)->first()->userType) == 2){
//                return redirect('/patient');
//            }else{
//                return redirect()->route('/');
//            }

        return $next($request);
    }
}
