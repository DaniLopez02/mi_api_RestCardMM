<?php
include_once __DIR__ .'/../config/database.php';
include_once __DIR__ ."/../controllers/CategoriaController.php";


$database = new Database();
$db = $database->getConnection();
$requestMethod = $_SERVER["REQUEST_METHOD"];
$controller = new CategoriaController($db,$requestMethod);
$controller->handleRequest();