<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserUuid
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('user_uuid')) {
            return redirect()->route('index');
        }

        return $next($request);
    }
}
