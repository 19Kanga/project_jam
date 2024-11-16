<?php
require_once __DIR__ . '/../models/purchases.php';
require_once __DIR__ . '/../config/database.php';

class PurchasesReportController {
    private $purchases;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->purchases = new Purchases($this->db);
    }

    // Get total bird purchase expenses
    public function getTotalBirdPurchases($startDate = null, $endDate = null) {
        return $this->purchases->getTotalExpensesByDate($startDate, $endDate);
    }

    // Get detailed bird purchase expenses
    public function getDetailedBirdPurchases($startDate = null, $endDate = null) {
        return $this->purchases->getDetailedExpensesByDate($startDate, $endDate);
    }
}
