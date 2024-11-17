<?php

require_once getcwd() . '/vendor/autoload.php';

use Config\Autoloader;
use Config\Env;
use Config\Database;
use Config\Server;

Autoloader::register();
Env::load();
Database::setup();
Server::routing();
Server::setup();