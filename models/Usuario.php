<?php
class Usuario {
    private $conn;
    private $table_name = "usuario";

    public $id;
    public $nombre;
   
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre , password=:password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":password", $this->password);
        return $stmt->execute();
    }

    public function obtenerTodos() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }
}
