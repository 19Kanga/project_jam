<?php
class Breeding {
    private $conn;
    private $table = 'breeding';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new breeding pair
    public function create($data) {
        $query = 'INSERT INTO ' . $this->table . ' (bird_id, partner_id, breeding_date, success_rate) 
                  VALUES (:bird_id, :partner_id, :breeding_date, :success_rate)';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':bird_id', $data['bird_id']);
        $stmt->bindParam(':partner_id', $data['partner_id']);
        $stmt->bindParam(':breeding_date', $data['breeding_date']);
        $stmt->bindParam(':success_rate', $data['success_rate']);
        return $stmt->execute();
    }

    // Get all breeding pairs
    public function getAll() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update a breeding pair
    public function update($id, $data) {
        $query = 'UPDATE ' . $this->table . ' SET bird_id = :bird_id, partner_id = :partner_id, breeding_date = :breeding_date, success_rate = :success_rate WHERE id = :id';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':bird_id', $data['bird_id']);
        $stmt->bindParam(':partner_id', $data['partner_id']);
        $stmt->bindParam(':breeding_date', $data['breeding_date']);
        $stmt->bindParam(':success_rate', $data['success_rate']);
        return $stmt->execute();
    }

    // Delete a breeding pair
    public function delete($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);  // Fixed the typo here
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
