<?php

class Categoria_Marca{
    private $conn;
    private $table_name = "categoria_marcas";

    public $categoria_id;
    public $marca_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function asociarProductoMarca(){
        $query = "INSERT INTO ".$this->table_name ." SET categoria_id=:categoria_id , marca_id=:marca_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":categoria_id", $this->categoria_id);
        $stmt->bindParam(":marca_id", $this->marca_id);

        return $stmt->execute();
    }
}