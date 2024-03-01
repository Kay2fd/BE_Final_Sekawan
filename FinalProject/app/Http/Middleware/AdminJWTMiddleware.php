<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminJWTMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            $admin = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['status' => 401, 'message' => 'Unauthorized'], 401);
        }

        if (!$admin) {
            return response()->json(['status' => 401, 'message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
