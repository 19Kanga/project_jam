<?php
class FeedUsage {
    private $conn;
    private $table = 'feed_usage';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = 'INSERT INTO ' . $this->table . ' (bird_id, feed_type, usage_date, quantity_used, cost) 
                  VALUES (:bird_id, :feed_type, :usage_date, :quantity_used, :cost)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':bird_id', $data['bird_id']);
        $stmt->bindParam(':feed_type', $data['feed_type']);
        $stmt->bindParam(':usage_date', $data['usage_date']);
        $stmt->bindParam(':quantity_used', $data['quantity_used']);
        $stmt->bindParam(':cost', $data['cost']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = 'UPDATE ' . $this->table . ' 
                  SET bird_id = :bird_id, feed_type = :feed_type, usage_date = :usage_date, quantity_used = :quantity_used, cost = :cost 
                  WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':bird_id', $data['bird_id']);
        $stmt->bindParam(':feed_type', $data['feed_type']);
        $stmt->bindParam(':usage_date', $data['usage_date']);
        $stmt->bindParam(':quantity_used', $data['quantity_used']);
        $stmt->bindParam(':cost', $data['cost']);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
