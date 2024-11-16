<?php
require_once __DIR__ . '/../models/purchases.php';
require_once __DIR__ . '/../config/database.php';

class PurchasesController {
    private $db;
    private $purchase;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->purchase = new Purchase($this->db);
    }

    // Get all purchases
    public function getAllPurchases() {
        return $this->purchase->getAll();
    }

    // Get a single purchase by ID
    public function getPurchaseById($id) {
        return $this->purchase->getById($id);
    }

    // Add a new purchase
    public function addPurchase($data) {
        return $this->purchase->create($data);
    }

    // Update an existing purchase
    public function updatePurchase($id, $data) {
        return $this->purchase->update($id, $data);
    }

    // Delete a purchase
    public function deletePurchase($id) {
        return $this->purchase->delete($id);
    }

    // Get total cost of all bird purchases
    public function getTotalBirdPurchases() {
        $query = "SELECT SUM(purchase_cost) as total_cost FROM purchases";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_cost'];
    }

    // Fetch purchases filtered by date range
    public function getBirdPurchasesByDate($startDate = null, $endDate = null) {
        return $this->purchase->getPurchasesByDate($startDate, $endDate);
    }

    

}
