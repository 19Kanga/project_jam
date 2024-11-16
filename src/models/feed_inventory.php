<?php
class FeedInventory {
    private $conn;
    private $table = 'feed_inventory';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all feed inventory records
    public function getAll() {
        $query = 'SELECT fi.id, ft.feed_type, fi.quantity, fi.last_updated
                  FROM ' . $this->table . ' fi
                  JOIN feed_types ft ON fi.feed_type_id = ft.id'; // Join with feed_types to get feed type name
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Get feed inventory by feed_type_id
    public function getFeedByTypeId($feed_type_id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE feed_type_id = :feed_type_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':feed_type_id', $feed_type_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Add a new feed type to the inventory
    public function addFeedType($feed_type_id, $quantity) {
        $query = 'INSERT INTO ' . $this->table . ' (feed_type_id, quantity) VALUES (:feed_type_id, :quantity)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':feed_type_id', $feed_type_id);
        $stmt->bindParam(':quantity', $quantity);
        return $stmt->execute();
    }

    // Update the feed quantity in the inventory
    public function updateFeedQuantity($feed_type_id, $quantity) {
        $query = 'UPDATE ' . $this->table . ' SET quantity = :quantity WHERE feed_type_id = :feed_type_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':feed_type_id', $feed_type_id);
        $stmt->bindParam(':quantity', $quantity);
        return $stmt->execute();
    }
}
