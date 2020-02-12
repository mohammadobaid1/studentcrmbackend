<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class RoleAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $role)
    {


        try {
            $token =  JWTAuth::parseToken();
            $user = $token->authenticate();
         

         error_log($user->id);

        } catch (TokenExpiredException $e){
            return $this->unauthorized('Your token has been expired');
        } catch (TokenInvalidException $e){
            return $this->unauthorized('Your token is invalid');
        } catch (JWTException $e){
            return $this->unauthorized('Please atatch bearer token');
        }


        if ($user && in_array($user->role, $role)){
            return $next($request);
        }



        return $this->unauthorized();
    }


    public function unauthorized($message = null){
        return response()->json([
            'message' => $message ? $message : 'You are unauthorized',
            'success'=> false
        ],401);
    }
}
