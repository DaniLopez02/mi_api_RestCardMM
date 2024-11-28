<?php
include_once __DIR__ .'/../config/database.php';
include_once __DIR__ . "/../models/Marca.php";

class MarcaController{

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
                $this->crearMarca();
                break;
            default:
                http_response_code(405);
                echo json_encode("Metodo no permitido en marca");

        }
    }

    private function getAll() {
        $marcaModel = new Marca($this->db);   
        $stmt = $marcaModel->obtenerTodos();        
        $marca = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($marca);
    }
    

    private function crearMarca() {
        $data = json_decode(file_get_contents("php://input"));
        $marca = new Marca($this->db);
        $marca->nombre = $data->nombre;

        if ($marca->create()) {
            http_response_code(201);
            echo json_encode(["mensaje" => "marca creado"]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al crearfds marca"]);
        }
    }
}
