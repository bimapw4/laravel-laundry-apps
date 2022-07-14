<?php

namespace App\Http\Middleware;

use App\Exceptions\UnauthorizedException;
use App\Services\Auth\AuthManager;
use Closure;
use Illuminate\Http\Request;

class PrivateAuth
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
       try {
            $jwt = $request->header("X-Token");
            $user = $this->ValidateToken($jwt);

            $request->request->add(["userdata" => $user["data"]]);
            return $next($request);
            // return $user;
       } catch (\UnauthorizedException $th) {
       }
    }

    public function ValidateToken($jwt)
    {
        if (!$jwt) {
            throw new UnauthorizedException("x-token cannot be empty!", 422);
        }

        return (new AuthManager)->DecodeJWT($jwt);
    }
}
