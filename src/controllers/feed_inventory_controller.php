<?php
require_once __DIR__ . '/../models/feed_inventory.php';
require_once __DIR__ . '/../config/database.php';

class FeedInventoryController {
    private $db;
    private $feedInventory;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->feedInventory = new FeedInventory($this->db);
    }

    // Fetch all feed inventory records
    public function getAllFeedInventory() {
        return $this->feedInventory->getAll();
    }
}
