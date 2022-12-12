<?php
class Computer {
    private $id;
    private $processor;
    private $motherboard;
    private $graphicsCard;

    public function __construct($id, $processor, $motherboard, $graphicsCard){
        $this->id = $id;
        $this->processor = $processor;
        $this->motherboard = $motherboard;
        $this->graphicsCard = $graphicsCard;
    }

    public function create(){
        $db = new Database();
        $conn = $db->connect();

        $sql = "INSERT INTO computers (processor, motherboard, graphicsCard) VALUES (:processor, :motherboard, :graphicsCard)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':processor', $this->processor);
        $stmt->bindParam(':motherboard', $this->motherboard);
        $stmt->bindParam(':graphicsCard', $this->graphicsCard);
        try {
            $stmt->execute();
            $id = $conn->lastInsertId();
            $conn = null;
            return $id;
        } catch(PDOException $e) {
            $db->dbError($e);
        }
    }

    public function list(){
        $db = new Database();
        $conn = $db->connect();

        $sql = "SELECT * FROM computers";
        $stmt = $conn->prepare($sql);
        try {
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return $result;
        } catch(PDOException $e) {
            $db->dbError($e);
        }
    }

    public function listById(){
        $db = new Database();
        $conn = $db->connect();

        $sql = "SELECT * FROM computers WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $conn = null;
            return $result;
        } catch(PDOException $e) {
            $db->dbError($e);
        }
    }

    public function delete(){
        $db = new Database();
        $conn = $db->connect();

        $sql = "DELETE FROM computers WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        try {
            $stmt->execute();
            $conn = null;
            return true;
        } catch(PDOException $e) {
            $db->dbError($e);
        }
    }
}
?>