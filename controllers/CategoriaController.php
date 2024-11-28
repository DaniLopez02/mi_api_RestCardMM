<?php
include_once __DIR__ .'/../config/database.php';
include_once __DIR__ . "/../models/Categoria.php";

class CategoriaController{

    private $db;

    private $requestMethod;

    public function __construct($db,$requestMethod){
        $this->db = $db;
        $this->requestMethod = $requestMethod;
    }

    public function handleRequest(){
        switch($this->requestMethod){
            case "GET":
                $this->getAll();
                break;
            case "POST":
                $this->crearCategoria();
                break;
            default:
                http_response_code(405);
                echo json_encode("Metodo no permitido en marca");

        }
    }

    private function getAll() {
        $categoriaModel = new Categoria($this->db);   
        $stmt = $categoriaModel->obtenerTodos();        
        $categoria = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($categoria);
    }
    

    private function crearCategoria() {
        $data = json_decode(file_get_contents("php://input"));
        $categoria = new Categoria($this->db);
        $categoria->nombre = $data->nombre;

        if ($categoria->create()) {
            http_response_code(201);
            echo json_encode(["mensaje" => "marca creado"]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al crearfds marca"]);
        }
    }
}
