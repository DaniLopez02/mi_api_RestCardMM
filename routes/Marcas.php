<?php
include_once __DIR__ .'/../config/database.php';
include_once __DIR__ ."/../controllers/MarcaController.php";


$database = new Database();
$db = $database->getConnection();
$requestMethod = $_SERVER["REQUEST_METHOD"];
$controller = new MarcaController($db,$requestMethod);
$controller->handleRequest();