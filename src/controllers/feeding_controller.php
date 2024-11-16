<?php
require_once __DIR__ . '/../models/feeding.php';  // Updated path using __DIR__
require_once __DIR__ . '/../config/database.php';  // Updated path using __DIR__

class FeedingController {
    private $db;
    private $feeding;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->feeding = new Feeding($this->db);
    }

    public function getAllFeeding() {
        return $this->feeding->getAll();
    }

    public function addFeeding($data) {
        return $this->feeding->create($data);
    }

    public function updateFeeding($id, $data) {
        return $this->feeding->update($id, $data);
    }

    public function deleteFeeding($id) {
        return $this->feeding->delete($id);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new FeedingController();
    $action = $_POST['action'];
    $data = $_POST;

    if ($action === 'add') {
        $controller->addFeeding($data);
    } elseif ($action === 'update') {
        $controller->updateFeeding($data['id'], $data);
    } elseif ($action === 'delete') {
        $controller->deleteFeeding($data['id']);
    }
}

