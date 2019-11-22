<?php

/* namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CORS;

class CORS{

    public function handle($request, Closure $next)
    {
      if(auth()->user()->is_admin == 1){
        return $next($request);
      }
        return redirect('/')->with('error','You have not admin access');
    }
} */