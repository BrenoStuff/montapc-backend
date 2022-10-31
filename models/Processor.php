<?php
class Processor {

    private $id;
    private $name;
    private $description;
    private $socket;
    private $typeMemory;
    private $pciExpress;
    private $price;
    private $image;

    function __construct($id, $name, $description, $socket, $typeMemory, $pciExpress, $price, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->socket = $socket;
        $this->typeMemory = $typeMemory;
        $this->pciExpress = $pciExpress;
        $this->price = $price;
        $this->image = $image;
    }

    function create(){
        $db = new Database();
        $conn = $db->connect();

        $sql = "INSERT INTO processors (name, socket, typememory, pciexpress, price, image, description) VALUES (:name, :socket, :typeMemory, :pciExpress, :price, :image, :description)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':socket', $this->socket);
        $stmt->bindParam(':typeMemory', $this->typeMemory);
        $stmt->bindParam(':pciExpress', $this->pciExpress);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':description', $this->description);
        try {
            $stmt->execute();
            $id = $conn->lastInsertId();
            $conn = null;
            return $id;
        } catch(PDOException $e) {
            $db->dbError($e);
        }
    }

    function list(){
        $db = new Database();
        $conn = $db->connect();

        $sql = "SELECT * FROM processors";
        $stmt = $conn->prepare($sql);
        try {
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            $db->dbError($e);
        }
    }

    function update(){
        $db = new Database();
        $conn = $db->connect();

        $sql = "UPDATE processors SET name = :name, socket = :socket, typememory = :typeMemory, pciexpress = :pciExpress, price = :price, image = :image, description = :description WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':socket', $this->socket);
        $stmt->bindParam(':typeMemory', $this->typeMemory);
        $stmt->bindParam(':pciExpress', $this->pciExpress);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $this->id);
        try {
            $stmt->execute();
            $rowsAffected = $stmt->rowCount();
            $conn = null;
            if($rowsAffected){
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            $db->dbError($e);
        }
    }

    function delete(){
        $db = new Database();
        $conn = $db->connect();

        $sql = "DELETE FROM processors WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        try {
            $stmt->execute();
            $rowsAffected = $stmt->rowCount();
            $conn = null;
            if($rowsAffected){
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            $db->dbError($e);
        }
    }
}
?>