<?php 

namespace Lib\JWT;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTLib
{
    public static function createJWTToken(string $userId) {
        $secretKey = $_ENV["JWT_SECRET_KEY"];
        $issuedAt = time();
        $expiredAt = $issuedAt + (int)$_ENV["JWT_EXP_TIME"];
    
        $payload = [
            'iat' => $issuedAt,
            'exp' => $expiredAt,
            'userId' => $userId,
        ];
    
        $token = JWT::encode($payload, $secretKey, "HS256");
    
        return $token; 
    }
}
