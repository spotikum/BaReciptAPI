<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Excetions;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $message = '';

        try{
            JWTAuth::parseToken()->authenticate();
            return $next($request);
        }catch(\Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
            $message = 'token expired';
        }
        catch(\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
            $message = 'token invalid';
        }
        catch(\Tymon\JWTAuth\Exceptions\JWTException $e){
            $message = 'provide token';
        }
        return response()->json([
            'success'=>false,
            'message'=>$message
        ]);
    }
}
