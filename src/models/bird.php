<?php
class Bird {
    private $conn;
    private $table = 'birds';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create new bird entry
    public function create($data) {
        $query = 'INSERT INTO ' . $this->table . ' (species, gender, purchase_date, purchase_cost, purchased_from, weight_at_purchase, age_at_purchase, hatched_date, remark, breeding_at_purchase) 
                  VALUES (:species, :gender, :purchase_date, :purchase_cost, :purchased_from, :weight_at_purchase, :age_at_purchase, :hatched_date, :remark, :breeding_at_purchase)';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':species', $data['species']);
        $stmt->bindParam(':gender', $data['gender']);
        $stmt->bindParam(':purchase_date', $data['purchase_date']);
        $stmt->bindParam(':purchase_cost', $data['purchase_cost']);
        $stmt->bindParam(':purchased_from', $data['purchased_from']);
        $stmt->bindParam(':weight_at_purchase', $data['weight_at_purchase']);
        $stmt->bindParam(':age_at_purchase', $data['age_at_purchase']);
        $stmt->bindParam(':hatched_date', $data['hatched_date']);
        $stmt->bindParam(':remark', $data['remark']);
        $stmt->bindParam(':breeding_at_purchase', $data['breeding_at_purchase']);
        return $stmt->execute();
    }

    // Get all birds
    public function getAll() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update bird by ID
    public function update($id, $data) {
        $query = 'UPDATE ' . $this->table . ' SET species = :species, gender = :gender, purchase_date = :purchase_date, purchase_cost = :purchase_cost, purchased_from = :purchased_from, weight_at_purchase = :weight_at_purchase, age_at_purchase = :age_at_purchase, hatched_date = :hatched_date, remark = :remark, breeding_at_purchase = :breeding_at_purchase WHERE id = :id';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':species', $data['species']);
        $stmt->bindParam(':gender', $data['gender']);
        $stmt->bindParam(':purchase_date', $data['purchase_date']);
        $stmt->bindParam(':purchase_cost', $data['purchase_cost']);
        $stmt->bindParam(':purchased_from', $data['purchased_from']);
        $stmt->bindParam(':weight_at_purchase', $data['weight_at_purchase']);
        $stmt->bindParam(':age_at_purchase', $data['age_at_purchase']);
        $stmt->bindParam(':hatched_date', $data['hatched_date']);
        $stmt->bindParam(':remark', $data['remark']);
        $stmt->bindParam(':breeding_at_purchase', $data['breeding_at_purchase']);
        return $stmt->execute();
    }

    // Delete bird by ID
    public function delete($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
