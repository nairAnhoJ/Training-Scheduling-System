<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if(Auth()->user()->first_time_login === '1'){
                return redirect()->route('password.change');
            }else{
                return $next($request);
            }
        }

        return redirect('/login');
    }
}
