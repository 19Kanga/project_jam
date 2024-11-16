<?php
require_once __DIR__ . '/../models/feed_purchase.php';
require_once __DIR__ . '/../models/feed_inventory.php';
require_once __DIR__ . '/../config/database.php';

class FeedPurchaseController {
    private $db;
    private $feedPurchase;
    private $feedInventory;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->feedPurchase = new FeedPurchase($this->db);
        $this->feedInventory = new FeedInventory($this->db); // To handle feed inventory updates
    }

    // Fetch total feed expenses
    public function getTotalFeedExpenses() {
        $query = "SELECT SUM(cost) as total_cost, feed_type, purchase_date, supplier, quantity 
                  FROM feed_purchases
                  GROUP BY feed_type";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $totalCost = 0;
        foreach ($result as $purchase) {
            $totalCost += $purchase['total_cost'];
        }

        return [
            'total_cost' => $totalCost,
            'details' => $result
        ];
    }

    // Fetch feed purchases filtered by date range
    public function getFeedPurchasesByDate($startDate = null, $endDate = null) {
        return $this->feedPurchase->getByDateRange($startDate, $endDate);
    }

    // Add feed purchase and update inventory
    public function addFeedPurchase($data) {
        $purchaseSuccess = $this->feedPurchase->create($data);

        if ($purchaseSuccess) {
            $existingFeed = $this->feedInventory->getFeedByTypeId($data['feed_type_id']);

            if ($existingFeed) {
                $newQuantity = $existingFeed['quantity'] + $data['quantity'];
                $this->feedInventory->updateFeedQuantity($data['feed_type_id'], $newQuantity);
            } else {
                $this->feedInventory->addFeedType($data['feed_type_id'], $data['quantity']);
            }
        }

        return $purchaseSuccess;
    }

    // Fetch all feed purchases
    public function getAllFeedPurchases() {
        return $this->feedPurchase->getAll();
    }
}
