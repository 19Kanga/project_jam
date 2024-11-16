<?php
require_once __DIR__ . '/../models/bird.php';  // Updated path using __DIR__
require_once __DIR__ . '/../config/database.php';  // Updated path using __DIR__

class BirdController {
    private $db;
    private $bird;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->bird = new Bird($this->db);
    }

    public function getAllBirds() {
        return $this->bird->getAll();
    }

    public function addBird($data) {
        return $this->bird->create($data);
    }

    public function updateBird($id, $data) {
        return $this->bird->update($id, $data);
    }

    public function deleteBird($id) {
        return $this->bird->delete($id);
    }
}

// Handle requests (this would be part of a routing system in a full framework)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new BirdController();
    $action = $_POST['action'];
    $data = $_POST;

    if ($action === 'add') {
        $controller->addBird($data);
    } elseif ($action === 'update') {
        $controller->updateBird($data['id'], $data);
    } elseif ($action === 'delete') {
        $controller->deleteBird($data['id']);
    }
}
