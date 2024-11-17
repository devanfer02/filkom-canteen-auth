<?php

namespace App\Validations;

class AuthValidation 
{
    public static function validateRegisterForm(array $data): array 
    {
        $keys = [
            'fullname',
            'email',
            'password',
            'wa_number'
        ];

        foreach($keys as $key) {
            if (!isset($data[$key])) {
                return [
                    'valid' => false,
                    'message' => $key . ' should not be empty'
                ];
            }
        }
        
        return [
            'valid' => true,
            'message' => $key . ' should not be empty'
        ];
    }

}