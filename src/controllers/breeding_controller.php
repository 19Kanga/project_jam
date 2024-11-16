<?php
require_once __DIR__ . '/../models/breeding.php';
require_once __DIR__ . '/../config/database.php';  // Updated path using __DIR__

class BreedingController {
    private $db;
    private $breeding;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->breeding = new Breeding($this->db);
    }

    public function getAllBreeding() {
        return $this->breeding->getAll();
    }

    public function addBreeding($data) {
        return $this->breeding->create($data);
    }

    public function updateBreeding($id, $data) {
        return $this->breeding->update($id, $data);
    }

    public function deleteBreeding($id) {
        return $this->breeding->delete($id);
    }
}

// Handle POST request (form submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new BreedingController();
    $action = $_POST['action'];
    $data = $_POST;

    if ($action === 'add') {
        $controller->addBreeding($data);
        header("Location: breeding.php");
        exit;
    } elseif ($action === 'update') {
        $controller->updateBreeding($data['id'], $data);
        header("Location: breeding.php");
        exit;
    } elseif ($action === 'delete') {
        $controller->deleteBreeding($data['id']);
        header("Location: breeding.php");
        exit;
    }
}

