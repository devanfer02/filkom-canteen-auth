<?php

namespace Config;

use Dotenv\Dotenv;

class Env 
{
    public static function load()
    {
        $dotenv = Dotenv::createImmutable(getcwd());
        $dotenv->load();
    }
}

