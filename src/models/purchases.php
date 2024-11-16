<?php
class Purchase {
    private $conn;
    private $table = 'purchases';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all purchases
    public function getAll() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a single purchase by ID
    public function getById($id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create a new purchase
    public function create($data) {
        $query = 'INSERT INTO ' . $this->table . ' (bird_id, purchase_date, purchase_cost, purchased_from) 
                  VALUES (:bird_id, :purchase_date, :purchase_cost, :purchased_from)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':bird_id', $data['bird_id']);
        $stmt->bindParam(':purchase_date', $data['purchase_date']);
        $stmt->bindParam(':purchase_cost', $data['purchase_cost']);
        $stmt->bindParam(':purchased_from', $data['purchased_from']);
        return $stmt->execute();
    }

    // Update an existing purchase
    public function update($id, $data) {
        $query = 'UPDATE ' . $this->table . ' 
                  SET bird_id = :bird_id, purchase_date = :purchase_date, purchase_cost = :purchase_cost, purchased_from = :purchased_from
                  WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':bird_id', $data['bird_id']);
        $stmt->bindParam(':purchase_date', $data['purchase_date']);
        $stmt->bindParam(':purchase_cost', $data['purchase_cost']);
        $stmt->bindParam(':purchased_from', $data['purchased_from']);
        return $stmt->execute();
    }

    // Delete a purchase by ID
    public function delete($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Fetch purchases filtered by date range
    public function getPurchasesByDate($startDate, $endDate) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE purchase_date BETWEEN :startDate AND :endDate';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalExpensesByDate($startDate = null, $endDate = null) {
        $query = "SELECT SUM(purchase_cost) AS total_cost FROM " . $this->table;
        if ($startDate && $endDate) {
            $query .= " WHERE purchase_date BETWEEN :startDate AND :endDate";
        }
        
        $stmt = $this->conn->prepare($query);
        if ($startDate && $endDate) {
            $stmt->bindParam(':startDate', $startDate);
            $stmt->bindParam(':endDate', $endDate);
        }
        
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get detailed bird purchase expenses within date range
    public function getDetailedExpensesByDate($startDate = null, $endDate = null) {
        $query = "SELECT species, purchase_date, purchase_cost FROM " . $this->table;
        if ($startDate && $endDate) {
            $query .= " WHERE purchase_date BETWEEN :startDate AND :endDate";
        }
        
        $stmt = $this->conn->prepare($query);
        if ($startDate && $endDate) {
            $stmt->bindParam(':startDate', $startDate);
            $stmt->bindParam(':endDate', $endDate);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




}
