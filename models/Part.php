<?php
class Part {

    private $id;
    private $name;
    private $description;
    private $socket;
    private $typeMemory;
    private $pciExpress;
    private $price;
    private $image;

    function __construct($id, $name, $socket, $typeMemory, $pciExpress, $price, $image, $description) {
        $this->id = $id;
        $this->name = $name;
        $this->socket = $socket;
        $this->typeMemory = $typeMemory;
        $this->pciExpress = $pciExpress;
        $this->price = $price;
        $this->image = $image;
        $this->description = $description;
    }

    function create(){
        $db = new Database();
        $conn = $db->connect();

        $sql = "INSERT INTO parts (name, socket, typeMemory, pciExpress, price, image, description) VALUES (:name, :socket, :typeMemory, :pciExpress, :price, :image, :description)";
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
            $this->id = $conn->lastInsertId();
            return $this;
        } catch(PDOException $e) {
            $db->dbError($e);
        }
    }

    function list(){
        $db = new Database();
        $conn = $db->connect();

        $sql = "SELECT * FROM parts";
        $stmt = $conn->prepare($sql);
        try {
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            $db->dbError($e);
        }
    }

    function delete(){
        $db = new Database();
        $conn = $db->connect();

        $sql = "DELETE FROM parts WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        try {
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            $db->dbError($e);
        }
    }
}
?>