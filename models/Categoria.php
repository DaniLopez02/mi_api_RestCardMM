<?php

class Categoria{
    private $conn;
    private $table_name = "categoria";

    public $id , $nombre;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create(){
        $query = "INSERT INTO ". $this->table_name . " SET nombre=:nombre";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre",$this->nombre);

       return $stmt->execute();
    }


    public function obtenerTodos() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }
}