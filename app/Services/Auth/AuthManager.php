<?php
namespace App\Services\Auth;

use App\Exceptions\UnauthorizedException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthManager
{
    public function generateJWT($data)
    {
        $key = env('JWT_SECRET_KEY');
        $payload = array(
            "data" => $data
        );
        $jwt = JWT::encode($payload, $key, 'HS256');

        return $jwt;
    }

    public function DecodeJWT($jwt)
    {
        $key = env('JWT_SECRET_KEY');
        return (array)JWT::decode($jwt, new Key($key, 'HS256'));
    }

    public function checkEmail($user)
    {
        if ($user->count() == 0) {
            throw new UnauthorizedException("email not found", 404);
        }
    }

    public function checkPassword($request, $user)
    {
        $passwordIsMatch = app('hash')->check($request->password, $user->password);

        if (!$passwordIsMatch) {
            throw new UnauthorizedException("invalid password", 422);
        }
    }
}
