<?php
class Sales {
    private $conn;
    private $table = 'sales';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data) {
        $query = 'INSERT INTO ' . $this->table . ' (bird_id, sale_date, sale_price, customer_name, customer_contact) 
                  VALUES (:bird_id, :sale_date, :sale_price, :customer_name, :customer_contact)';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':bird_id', $data['bird_id']);
        $stmt->bindParam(':sale_date', $data['sale_date']);
        $stmt->bindParam(':sale_price', $data['sale_price']);
        $stmt->bindParam(':customer_name', $data['customer_name']);
        $stmt->bindParam(':customer_contact', $data['customer_contact']);
        return $stmt->execute();
    }

    public function getAll() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $query = 'UPDATE ' . $this->table . ' SET bird_id = :bird_id, sale_date = :sale_date, sale_price = :sale_price, customer_name = :customer_name, customer_contact = :customer_contact WHERE id = :id';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':bird_id', $data['bird_id']);
        $stmt->bindParam(':sale_date', $data['sale_date']);
        $stmt->bindParam(':sale_price', $data['sale_price']);
        $stmt->bindParam(':customer_name', $data['customer_name']);
        $stmt->bindParam(':customer_contact', $data['customer_contact']);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = 'DELETE FROM '
    . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>