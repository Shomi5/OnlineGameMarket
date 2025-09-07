<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAutorizacija
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guest()){
            return redirect("/login");
        }

        if(Auth::user()->status == 0 || Auth::user()->status == 2)
        {
            return redirect("userAccount");
        }
        return $next($request);
    }
}
