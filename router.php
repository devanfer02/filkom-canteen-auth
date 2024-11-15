<?php

header("Content-Type: application/json");

$allowed = [
    '/auth',
    '/',
    '/index.php'
];

$requestUri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

function isAllowed($uri, $allowed) {
    foreach ($allowed as $prefix) {
        if (strpos($uri, $prefix) === 0) {
            return true; 
        }
    }
    return false; 
}

if (!isAllowed($requestUri, $allowed)) {
    header("HTTP/1.1 404 Not Found");
    echo json_encode([
        'message' => 'not found'
    ]);
    exit;
}

if ($requestUri === "/") $requestUri = "/index.php";

$filePath = __DIR__ . $requestUri;


if (!is_file($filePath)) {

    header("HTTP/1.1 404 Not Found");
    echo json_encode([
        'message' => 'File not found'
    ]);
    exit; 
    
}

require $filePath; 