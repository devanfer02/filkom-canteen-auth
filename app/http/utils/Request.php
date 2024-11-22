<?php

namespace App\Http\Utils;

class Request 
{
    public static function getJsonData()
    {
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);

        return $data;
    }
}