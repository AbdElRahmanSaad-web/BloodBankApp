<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Token
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->currentAccessToken()->abilities[0] == "verify_otp" ||
            Auth::user()->currentAccessToken()->abilities[0] == "register"){
            return (new ApiResponse(401,'This Token used for verify otp or register only',[]))->send();
        }
        return $next($request);
    }
}
