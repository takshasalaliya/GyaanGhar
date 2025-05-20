<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(session()->has('firebase_user')  ){
        return $next($request);
        }
        else{
            session()->forget('firebase_user');
            Auth::logout();
            return redirect('login')->with('message','First Login With Eamil and Password');
        }
    }
}
