<?php
include_once __DIR__ .'/../config/database.php';
include_once __DIR__ . "/../models/Producto.php";

class ProductoController{

    private $db;

    private $requestMethod;

    public function __construct($db,$requestMethod){
        $this->db = $db;
        $this->requestMethod = $requestMethod;
    }

    public function handleRequest(){
        switch($this->requestMethod){
            case "GET":
                ///productos?usuario_id=1
                $usuario_id = isset($_GET['usuario_id']) ? intval($_GET['usuario_id']) : null;
            if ($usuario_id) {
                $this->obtenerProductosPorUsuario($usuario_id);
            } else {
                http_response_code(400); // Bad Request
                echo json_encode("usuario_id es requerido");
            }
                break;
            case "POST":
                $this->crearProducto();
                break;
            default:
                http_response_code(405);
                echo json_encode("Metodo no permitido en producto");

        }
    }

    private function obtenerProductosPorUsuario($usuario_id) {
        $producto = new Producto($this->db);
        $stmt = $producto->obtenerPorUsuario($usuario_id);
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($productos);
    }
    

    private function crearProducto() {
        $data = json_decode(file_get_contents("php://input"));
        $producto = new Producto($this->db);
        $producto->nombre = $data->nombre;
        $producto->descripcion = $data->descripcion;
        $producto->usuario_id = $data->usuario_id;

        if ($producto->crear()) {
            http_response_code(201);
            echo json_encode(["mensaje" => "Producto creado"]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al crear producto"]);
        }
    }
}
