<?php

require getcwd() . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(getcwd());
$dotenv->load();

