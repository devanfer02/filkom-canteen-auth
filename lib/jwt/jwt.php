<?php 

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function createJWTToken() {
    $secretKey = $_ENV["JWT_SECRET_KEY"];
    $issuedAt = time();
    $expiredAt = $issuedAt + (int)$_ENV["JWT_EXP_TIME"];

    $payload = [
        'iat' => $issuedAt,
        'exp' => $expiredAt,
        'userId' => '',
    ];

    $token = JWT::encode($payload, $secretKey, "HS256");

    return $token; 
}