<?php
require_once __DIR__ . '/../models/sales.php';  // Updated path using __DIR__
require_once __DIR__ . '/../config/database.php';  // Updated path using __DIR__

class SalesController {
    private $db;
    private $sales;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->sales = new Sales($this->db);
    }

    public function getAllSales() {
        return $this->sales->getAll();
    }

    public function addSales($data) {
        return $this->sales->create($data);
    }

    public function updateSales($id, $data) {
        return $this->sales->update($id, $data);
    }

    public function deleteSales($id) {
        return $this->sales->delete($id);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new SalesController();
    $action = $_POST['action'];
    $data = $_POST;

    if ($action === 'add') {
        $controller->addSales($data);
    } elseif ($action === 'update') {
        $controller->updateSales($data['id'], $data);
    } elseif ($action === 'delete') {
        $controller->deleteSales($data['id']);
    }
}
?>
