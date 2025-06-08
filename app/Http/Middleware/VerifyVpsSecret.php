<?php

namespace App\Http\Middleware;

use Closure;

class VerifyVpsSecret
{
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();
        if ($token !== env('WEBHOOK_SHARED_SECRET')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
