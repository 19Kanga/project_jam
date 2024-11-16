<?php
class Environment {
    private $conn;
    private $table = 'environment';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data) {
        $query = 'INSERT INTO ' . $this->table . ' (measurement_date, temperature, humidity, aviary_location) 
                  VALUES (:measurement_date, :temperature, :humidity, :aviary_location)';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':measurement_date', $data['measurement_date']);
        $stmt->bindParam(':temperature', $data['temperature']);
        $stmt->bindParam(':humidity', $data['humidity']);
        $stmt->bindParam(':aviary_location', $data['aviary_location']);
        return $stmt->execute();
    }

    public function getAll() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $query = 'UPDATE ' . $this->table . ' SET measurement_date = :measurement_date, temperature = :temperature, humidity = :humidity, aviary_location = :aviary_location WHERE id = :id';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':measurement_date', $data['measurement_date']);
        $stmt->bindParam(':temperature', $data['temperature']);
        $stmt->bindParam(':humidity', $data['humidity']);
        $stmt->bindParam(':aviary_location', $data['aviary_location']);
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
