<?php
include_once __DIR__ .'/../config/database.php';
include_once __DIR__ ."/../controllers/ProductoController.php";


$database = new Database();
$db = $database->getConnection();
$requestMethod = $_SERVER["REQUEST_METHOD"];
$controller = new ProductoController($db,$requestMethod);
$controller->handleRequest();