<?php
include_once __DIR__ .'/../config/database.php';
include_once __DIR__ . "/../models/Categoria_Producto.php";

class Categorias_ProductosController{
    
    private $db;

    private $requestMethod;

    public function __construct($db,$requestMethod){
        $this->db = $db;
        $this->requestMethod = $requestMethod;
    } 

    public function handlerequest(){
        switch($this->requestMethod){
            case "POST":
                $this->asociarCatProducto();
                break;
            case "DELETE":
                break;
            default:
                http_response_code(405);
                echo json_encode("Metodo no permitido en la relacion de");
        }
    }

    public function asociarCatProducto(){
        $data = json_decode(file_get_contents("php://input"));
        $categoriaProducto_model = new Categoria_Producto($this->db);
        $categoriaProducto_model->categoria_id = $data->categoria_id;
        $categoriaProducto_model->producto_id = $data->producto_id;

        if ($categoriaProducto_model->asociarProductoMarca()) {
            http_response_code(201);
            echo json_encode(["mensaje" => "Categoria asociado con el producto"]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al asociar  la categoria con el producto "]);
        }
    }
    public function quitarRelacion(){
        
    }
}