<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        try{
            // mengirimkan token ke variable user
            $user = JWTAuth::parseToken()->authenticate();

            if (!in_array($user->role, $roles)){
                return response()->json([
                    'status' => 403,
                    'message' => 'Unauthorized'
                ], 403);
            }

            return $next($request);
        } catch (JWTException $e) {
            return response()->json([
                'status' => 401,
                'message' => 'Token is invalid or expired'
            ], 401);
        }
    }
}
