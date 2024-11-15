<?php

include_once("config/env/env_conf.php");

header("Content-Type: application/json");

echo json_encode([
    'message' => 'Hello World'
]);