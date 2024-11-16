<?php
class FeedPurchase {
    private $conn;
    private $table = 'feed_purchases';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all feed purchases
    public function getAll() {
        $query = 'SELECT fp.id, ft.feed_type, fp.purchase_date, fp.supplier, fp.quantity, fp.cost
                  FROM ' . $this->table . ' fp
                  JOIN feed_types ft ON fp.feed_type_id = ft.id'; // Joining feed_purchases with feed_types
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch a single feed purchase by ID
    public function getById($id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create a new feed purchase
    public function create($data) {
        $query = 'INSERT INTO ' . $this->table . ' (feed_type_id, purchase_date, supplier, quantity, cost) 
                  VALUES (:feed_type_id, :purchase_date, :supplier, :quantity, :cost)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':feed_type_id', $data['feed_type_id']);
        $stmt->bindParam(':purchase_date', $data['purchase_date']);
        $stmt->bindParam(':supplier', $data['supplier']);
        $stmt->bindParam(':quantity', $data['quantity']);
        $stmt->bindParam(':cost', $data['cost']);
        return $stmt->execute();
    }
    

    // Update an existing feed purchase
    public function update($id, $data) {
        $query = 'UPDATE ' . $this->table . ' SET feed_type = :feed_type, purchase_date = :purchase_date, supplier = :supplier, quantity = :quantity, cost = :cost WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':feed_type', $data['feed_type']);
        $stmt->bindParam(':purchase_date', $data['purchase_date']);
        $stmt->bindParam(':supplier', $data['supplier']);
        $stmt->bindParam(':quantity', $data['quantity']);
        $stmt->bindParam(':cost', $data['cost']);
        return $stmt->execute();
    }

    // Delete a feed purchase
    public function delete($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getByDateRange($startDate = null, $endDate = null) {
        $query = 'SELECT fp.id, ft.feed_type, fp.purchase_date, fp.supplier, fp.quantity, fp.cost
                  FROM ' . $this->table . ' fp
                  JOIN feed_types ft ON fp.feed_type_id = ft.id WHERE 1=1';
        
        if ($startDate && $endDate) {
            $query .= ' AND fp.purchase_date BETWEEN :startDate AND :endDate';
        }

        $stmt = $this->conn->prepare($query);

        if ($startDate && $endDate) {
            $stmt->bindParam(':startDate', $startDate);
            $stmt->bindParam(':endDate', $endDate);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

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
?>
