<?php 

namespace App\Services;

use App\Models\User;
use App\Validations\UserValidation;
use Illuminate\Database\QueryException;
use Lib\JWT\JWTLib;

class UserService 
{
    public function register(array $data): array 
    {
        $valid = UserValidation::validateRegisterForm($data);

        if (!$valid['valid']) 
        {
            return [
                'code' => 400,
                'status' => 'fail',
                'message' => $valid['message']
            ];
        }

        try {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

            User::create($data);

            return [
                'code' => 201,
                'status' => 'success',
                'message' => 'successfully register user to system'
            ];
        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), "23505") || str_contains($e->getMessage(), "1062") ) {
                return [
                    'code' => 409,
                    'status' => 'fail',
                    'message' => 'email address already in use'
                ];                
            }
            error_log("[USER SERVCIE][register] ERR: " . $e->getMessage());
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'internal server error'
            ];
        }

    }   

    public function login(array $data) 
    {
        try {
            $user = User::where('email', '=', $data['email'])->first();

            if(!isset($user)) 
            {
                return [
                    'code' => 400,
                    'status' => 'fail',
                    'message' => 'invalid email or password'
                ];
            }

            if (!password_verify($data['password'], $user->password))
            {
                return [
                    'code' => 400,
                    'status' => 'fail',
                    'message' => 'invalid email or password'
                ];
            }

            $token = JWTLib::createJWTToken($user->user_id);

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'successfully login to system',
                'data' => [
                    'token' => $token
                ]
            ];

        } catch (\Exception $e) {
            error_log("[USER SERVCIE][login] ERR: " . $e->getMessage());
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'internal server error'
            ];
        }
    }
}
