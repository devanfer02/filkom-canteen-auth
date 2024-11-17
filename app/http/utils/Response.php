<?php

namespace App\Http\Utils;

class HTTPResponse 
{
    public static function send(int $code, array $data)
    {
        http_response_code($code);

        echo json_encode($data);
    }
}