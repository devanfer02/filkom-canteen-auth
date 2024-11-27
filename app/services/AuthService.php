<?php 

namespace App\Services;

use App\Models\Admin;
use App\Models\User;
use App\Validations\AuthValidation;
use Lib\JWT\JWTLib;

class AuthService 
{
    public function register(array $data): array 
    {
        $valid = AuthValidation::validateRegisterForm($data);

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
            error_log("[AUTH SERVICE][register] ERR: " . $e->getMessage());
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'internal server error'
            ];
        }

    }   

    public function login(array $data, string $mode) 
    {
        try {

            if ($mode === 'User')
            {
                $user = User::where('email', '=', $data['email'])->first();
            } else 
            {
                $user = Admin::with('role')->where('username', '=', $data['username'])->first();
            }
            

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

            error_log("ROLE: " . $user->role->role_id);

            $token = JWTLib::createJWTToken(
                $mode === 'Admin' ? $user->admin_id : $user->user_id, 
                $mode, 
                $user->role->role_id ?? "User"
            );

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'successfully login to system',
                'data' => [
                    'token' => $token
                ]
            ];

        } catch (\Exception $e) {
            error_log("[AUTH SERVICE][login] ERR: " . $e->getMessage());
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'internal server error'
            ];
        }
    }

}
