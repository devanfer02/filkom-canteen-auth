<?php 

namespace Lib\JWT;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTLib
{
    public static function createJWTToken(string $userId, string $mode, string $role) {
        $secretKey = $_ENV["JWT_SECRET_KEY"];
        $issuedAt = time();
        $expiredAt = $issuedAt + (int)$_ENV["JWT_EXP_TIME"];
    
        $payload = [
            'iat' => $issuedAt,
            'exp' => $expiredAt,
            'userId' => $userId,
            'iss' => $mode === 'Admin' ? $_ENV['JWT_ADMIN_ROLE'] : $_ENV['JWT_USER_ROLE'],
            'role' => $mode === 'Admin' ? 'User' : $role,
        ];
    
        $token = JWT::encode($payload, $secretKey, "HS256");
    
        return $token; 
    }
}
