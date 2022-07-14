<?php
namespace App\Services\Auth;
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
}
