<?php

namespace Config;

use App\Http\Controllers\UserController;
use App\Http\Utils\HTTPResponse;

require_once("app/http/utils/Response.php");
require_once("app/http/controllers/UserController.php");
require_once("app/services/UserService.php");
require_once("app/models/User.php");
require_once("app/validations/UserValidation.php");

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
        $userCtr = new UserController();
        Router::get('/health', function() {
            HTTPResponse::send(200, [
                'message' => 'server is running ok!'
            ]);
        });

        Router::post('/auth/register', function() use($userCtr) {
            $jsonData = file_get_contents("php://input");
            $data = json_decode($jsonData);
            echo json_encode($data);
        });
    }

}