<?php 

namespace App\Services;

use App\Models\User;
use App\Validations\UserValidation;

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
            User::create($data);

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'successfully register user to system'
            ];
        } catch (\Exception $e) {
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

    }
}
