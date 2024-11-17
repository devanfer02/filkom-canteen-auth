<?php

namespace Config;

use App\Http\Controllers\AuthController;
use App\Http\Utils\HTTPResponse;

require_once("app/http/utils/Response.php");
require_once("app/http/controllers/AuthController.php");
require_once("app/services/AuthService.php");
require_once("app/models/User.php");
require_once("app/validations/AuthValidation.php");

require_once("lib/jwt/jwt.php");

class Server
{
    public static function setup()
    {
        header("Content-Type: application/json");

        $requestUri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        Router::call($_SERVER['REQUEST_METHOD'], $requestUri);
    }

    public static function routing()
    {
        // controllers
        $userCtr = new AuthController();
        Router::get('/health', function() {
            HTTPResponse::send(200, [
                'message' => 'server is running ok!'
            ]);
        });

        Router::post('/auth/register', function() use($userCtr) {
            $jsonData = file_get_contents("php://input");
            $data = json_decode($jsonData, true);
            
            $userCtr->register($data);
        });

        Router::post('/auth/login', function() use($userCtr) {
            $jsonData = file_get_contents("php://input");
            $data = json_decode($jsonData, true);
            
            $userCtr->login($data);
        });
    }

}