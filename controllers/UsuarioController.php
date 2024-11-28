<?php
include_once __DIR__ .'/../config/database.php';
include_once __DIR__ . "/../models/Usuario.php";

class UsuarioController{

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
                $this->crearUsuario();
                break;
            default:
                http_response_code(405);
                echo json_encode("Metodo no permitido en usuarios");

        }
    }

    private function getAll() {
        $usuarioModel = new Usuario($this->db);   
        $stmt = $usuarioModel->obtenerTodos();        
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($usuarios);
    }
    

    private function crearUsuario() {
        $data = json_decode(file_get_contents("php://input"));
        $usuario = new Usuario($this->db);
        $usuario->nombre = $data->nombre;
        $usuario->password = $data->password;

        if ($usuario->crear()) {
            http_response_code(201);
            echo json_encode(["mensaje" => "Usuario creado"]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al crear usuario"]);
        }
    }
}
