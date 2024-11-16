<?php
class FeedPurchase {
    private $conn;
    private $table = 'feed_purchases';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get total feed expenses within date range
    public function getTotalExpensesByDate($startDate = null, $endDate = null) {
        $query = "SELECT SUM(cost) AS total_cost FROM " . $this->table;
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

    // Get detailed feed expenses within date range
    public function getDetailedExpensesByDate($startDate = null, $endDate = null) {
        $query = "SELECT feed_type, purchase_date, quantity, cost FROM " . $this->table;
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
