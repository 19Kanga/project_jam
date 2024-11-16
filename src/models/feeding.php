<?php
class Feeding {
    private $conn;
    private $table = 'feeding';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data) {
        $query = 'INSERT INTO ' . $this->table . ' (bird_id, feeding_time, food_type, quantity) 
                  VALUES (:bird_id, :feeding_time, :food_type, :quantity)';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':bird_id', $data['bird_id']);
        $stmt->bindParam(':feeding_time', $data['feeding_time']);
        $stmt->bindParam(':food_type', $data['food_type']);
        $stmt->bindParam(':quantity', $data['quantity']);
        return $stmt->execute();
    }

    public function getAll() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $query = 'UPDATE ' . $this->table . ' SET bird_id = :bird_id, feeding_time = :feeding_time, food_type = :food_type, quantity = :quantity WHERE id = :id';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':bird_id', $data['bird_id']);
        $stmt->bindParam(':feeding_time', $data['feeding_time']);
        $stmt->bindParam(':food_type', $data['food_type']);
        $stmt->bindParam(':quantity', $data['quantity']);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
