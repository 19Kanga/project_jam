<?php
require_once '../models/environment.php';
require_once '../config/database.php';

class EnvironmentController {
    private $db;
    private $environment;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->environment = new Environment($this->db);
    }

    public function getAllEnvironmentData() {
        return $this->environment->getAll();
    }

    public function addEnvironmentData($data) {
        return $this->environment->create($data);
    }

    public function updateEnvironmentData($id, $data) {
        return $this->environment->update($id, $data);
    }

    public function deleteEnvironmentData($id) {
        return $this->environment->delete($id);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new EnvironmentController();
    $action = $_POST['action'];
    $data = $_POST;

    if ($action === 'add') {
        $controller->addEnvironmentData($data);
    } elseif ($action === 'update') {
        $controller->updateEnvironmentData($data['id'], $data);
    } elseif ($action === 'delete') {
        $controller->deleteEnvironmentData($data['id']);
    }
}
?>
