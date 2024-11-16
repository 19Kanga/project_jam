<?php
class Medical {
    private $conn;
    private $table = 'medical_records';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all medical records
    public function getAll() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get total medical expenses
    public function getTotalMedicalExpenses() {
        $query = 'SELECT SUM(cost) as total_cost FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Add a new medical record
    public function create($data) {
        $query = 'INSERT INTO ' . $this->table . ' (bird_id, checkup_date, treatment, notes, cost) 
                  VALUES (:bird_id, :checkup_date, :treatment, :notes, :cost)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':bird_id', $data['bird_id']);
        $stmt->bindParam(':checkup_date', $data['checkup_date']);
        $stmt->bindParam(':treatment', $data['treatment']);
        $stmt->bindParam(':notes', $data['notes']);
        $stmt->bindParam(':cost', $data['cost']);
        return $stmt->execute();
    }

    public function getTotalExpensesByDate($startDate = null, $endDate = null) {
        $query = "SELECT SUM(cost) AS total_cost FROM " . $this->table;
        if ($startDate && $endDate) {
            $query .= " WHERE checkup_date BETWEEN :startDate AND :endDate";
        }
        
        $stmt = $this->conn->prepare($query);
        if ($startDate && $endDate) {
            $stmt->bindParam(':startDate', $startDate);
            $stmt->bindParam(':endDate', $endDate);
        }
        
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get detailed medical expenses within date range
    public function getDetailedExpensesByDate($startDate = null, $endDate = null) {
        $query = "SELECT notes, checkup_date, cost FROM " . $this->table;
        if ($startDate && $endDate) {
            $query .= " WHERE checkup_date BETWEEN :startDate AND :endDate";
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
