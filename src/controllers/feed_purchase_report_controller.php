<?php
require_once __DIR__ . '/../models/feed_purchase.php';
require_once __DIR__ . '/../config/database.php';

class FeedPurchaseReportController {
    private $feedPurchase;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->feedPurchase = new FeedPurchase($this->db);
    }

    // Get total feed expenses
    public function getTotalFeedExpenses($startDate = null, $endDate = null) {
        return $this->feedPurchase->getTotalExpensesByDate($startDate, $endDate);
    }

    // Get detailed feed purchases for report
    public function getDetailedFeedExpenses($startDate = null, $endDate = null) {
        return $this->feedPurchase->getDetailedExpensesByDate($startDate, $endDate);
    }
}
