<?php
require_once __DIR__ . '/../models/feed_type.php';
require_once __DIR__ . '/../config/database.php';

class FeedTypeController {
    private $db;
    private $feedType;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->feedType = new FeedType($this->db);
    }

    public function getAllFeedTypes() {
        return $this->feedType->getAll();
    }
}
