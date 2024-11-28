<?php

class Categoria_Producto{
    private $conn;
    private $table_name = "categoria_productos";

    public $categoria_id;
    public $producto_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function asociarProductoMarca(){
        $query = "INSERT INTO ".$this->table_name ." SET categoria_id=:categoria_id , producto_id=:producto_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":categoria_id", $this->categoria_id);
        $stmt->bindParam(":producto_id", $this->producto_id);

        return $stmt->execute();
    }
}