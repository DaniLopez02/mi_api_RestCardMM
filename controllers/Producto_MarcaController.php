<?php
include_once __DIR__ .'/../config/database.php';
include_once __DIR__ . "/../models/Producto_Marca.php";

class Producto_MarcaController{
    
    private $db;

    private $requestMethod;

    public function __construct($db,$requestMethod){
        $this->db = $db;
        $this->requestMethod = $requestMethod;
    } 

    public function handlerequest(){
        switch($this->requestMethod){
            case "POST":
                $this->asociarProMarc();
                break;
            case "DELETE":
                break;
            default:
                http_response_code(405);
                echo json_encode("Metodo no permitido en la relacion de");
        }
    }

    public function asociarProMarc(){
        $data = json_decode(file_get_contents("php://input"));
        $productoMarca_Model = new Producto_Marca($this->db);
        $productoMarca_Model->producto_id = $data->producto_id;
        $productoMarca_Model->marca_id = $data->marca_id;

        if ($productoMarca_Model->asociarProductoMarca()) {
            http_response_code(201);
            echo json_encode(["mensaje" => "Producto asociado con la marca"]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al asociar  producto con marca "]);
        }
    }
    public function quitarRelacion(){
        
    }
}