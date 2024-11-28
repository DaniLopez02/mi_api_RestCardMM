<?php
include_once __DIR__ .'/../config/database.php';
include_once __DIR__ . "/../models/Categoria_Marca.php";

class Categorias_MarcaController{
    
    private $db;

    private $requestMethod;

    public function __construct($db,$requestMethod){
        $this->db = $db;
        $this->requestMethod = $requestMethod;
    } 

    public function handlerequest(){
        switch($this->requestMethod){
            case "POST":
                $this->asociarCatMarc();
                break;
            case "DELETE":
                break;
            default:
                http_response_code(405);
                echo json_encode("Metodo no permitido en la relacion de");
        }
    }

    public function asociarCatMarc(){
        $data = json_decode(file_get_contents("php://input"));
        $categoriaMarca_Model = new Categoria_Marca($this->db);
        $categoriaMarca_Model->categoria_id = $data->categoria_id;
        $categoriaMarca_Model->marca_id = $data->marca_id;

        if ($categoriaMarca_Model->asociarProductoMarca()) {
            http_response_code(201);
            echo json_encode(["mensaje" => "Categoria asociado con la marca"]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al asociar  la categoria con marca "]);
        }
    }
    public function quitarRelacion(){
        
    }
}