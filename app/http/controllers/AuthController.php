<?php 

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Http\Utils\HTTPResponse;

class AuthController 
{
    private $AuthService;

    public function __construct()
    {
        $this->AuthService = new AuthService();
    }

    public function register(array $data)
    {   
        $resp = $this->AuthService->register($data);

        HTTPResponse::send($resp['code'], $resp);
    }

    public function login(array $data, string $mode = 'User')
    {
        $resp = $this->AuthService->login($data, $mode);

        HTTPResponse::send($resp['code'], $resp);
    }
}