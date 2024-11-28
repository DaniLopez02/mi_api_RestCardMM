<?php
class Producto {
    private $conn;
    private $table_name = "producto";

    public $id;
    public $nombre;
    public $descripcion;
    
    public $usuario_id;

    public function __construct($db) {
        $this->conn = $db;                                                                                                  
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, descripcion=:descripcion , usuario_id=:usuario_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":usuario_id", $this->usuario_id);

        return $stmt->execute();
    }

    public function obtenerPorUsuario($usuario_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE usuario_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $usuario_id);
        $stmt->execute();
        return $stmt;
    }

}
