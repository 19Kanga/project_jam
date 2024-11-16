<?php


class User {
    private $conn;
    private $table = 'users';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all users
    public function getAllUsers() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch a single user by ID
    public function getUserById($id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create a new user
    public function createUser($data) {
        $query = 'INSERT INTO ' . $this->table . ' (username, password, role) VALUES (:username, :password, :role)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':password', $data['password']); // Ensure password is hashed before inserting
        $stmt->bindParam(':role', $data['role']);
        return $stmt->execute();
    }

    // Update an existing user
    public function updateUser($id, $data) {
        $query = 'UPDATE ' . $this->table . ' SET username = :username, password = :password, role = :role WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':role', $data['role']);
        return $stmt->execute();
    }

    // Delete a user
    public function deleteUser($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
