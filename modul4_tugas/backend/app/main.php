<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");  
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include "Routes/BookRoutes.php";
include "Routes/TestimoniRoutes.php";

use app\Routes\BookRoutes;
use app\Routes\TestimoniRoutes;

// Menangkap request method
$method = $_SERVER['REQUEST_METHOD'];

// Menangkap request path
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Panggil routes
$bookRoutes = new BookRoutes();
$bookRoutes->handle($method, $path);

$testimoniRoutes = new TestimoniRoutes();
$testimoniRoutes->handle($method, $path);