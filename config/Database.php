<?php

namespace Config;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database 
{
    public static function setup()
    {
        $capsule = new Capsule();
        
        $capsule->addConnection([
            'driver' => 'pgsql',          
            'host' => $_ENV["DB_HOST"],        
            'database' => $_ENV["DB_NAME"], 
            'username' => $_ENV["DB_USER"], 
            'password' => $_ENV["DB_PASS"], 
        ]);
        
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
