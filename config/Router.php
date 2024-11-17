<?php 

namespace Config;

use App\Http\Utils\HTTPResponse;

class Router 
{
    private static $routes = []; 

    public static function call(string $method, string $path)
    {
        if (!isset(self::$routes[$method][$path])) 
        {
            HTTPResponse::send(400, [
                'message' => 'not found'
            ]);
            exit; 
        }

        self::$routes[$method][$path]();
    }

    public static function get(string $path, $callback)
    {

        self::$routes['GET'][$path] = $callback;
    }

    public static function put(string $path, $callback)
    {
        self::$routes['PUT'][$path] = $callback;
    }

    public static function post(string $path, $callback)
    {

        self::$routes['POST'][$path] = $callback;
    }

    public static function delete(string $path, $callback)
    {

        self::$routes['DELETE'][$path] = $callback;
    }

}