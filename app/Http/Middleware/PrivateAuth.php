<?php

namespace App\Http\Middleware;

use App\Exceptions\UnauthorizedException;
use App\Services\Auth\AuthManager;
use Closure;
use Exception;
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
            $jwt = $request->header("token");
            $user = $this->ValidateToken($jwt);

            $request->request->add(["userdata" => $user["data"]]);
            return $next($request);
            // return $user;
       } catch (\Exception $e) {
            throw new UnauthorizedException($e->getMessage(), 422);
       }
    }

    public function ValidateToken($jwt)
    {
        if (!$jwt) {
            throw new Exception("token cannot be empty!");
        }

        return (new AuthManager)->DecodeJWT($jwt);
    }
}
