<?php 

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Utils\HTTPResponse;

class UserController 
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function register(array $data)
    {   
        $resp = $this->userService->register($data);

        HTTPResponse::send($resp['code'], $resp);
    }

    public function login(array $data)
    {
        $resp = $this->userService->login($data);

        HTTPResponse::send($resp['code'], $resp);
    }
}