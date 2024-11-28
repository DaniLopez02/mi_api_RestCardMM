<?php

class Producto_Marca{
    private $conn;
    private $table_name = "producto_marca";

    public $producto_id;
    public $marca_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function asociarProductoMarca(){
        $query = "INSERT INTO ".$this->table_name ." SET producto_id=:producto_id , marca_id=:marca_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":producto_id", $this->producto_id);
        $stmt->bindParam(":marca_id", $this->marca_id);

        return $stmt->execute();
    }
}