<?php
require_once __DIR__ . '/../models/bird_stat.php';
require_once __DIR__ . '/../config/database.php';

class BirdController {
    private $birdModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->birdModel = new BirdModel($db);
    }

    // Fetch stats
    public function getBirdsBoughtPerYear() {
        return $this->birdModel->getBirdsBoughtPerYear();
    }

    public function getBirdCountByGender() {
        return $this->birdModel->getBirdCountByGender();
    }

    public function getSpeciesGenderCount() {
        return $this->birdModel->getSpeciesGenderCount();
    }

    public function getTotalSpentPerYear() {
        return $this->birdModel->getTotalSpentPerYear();
    }

    public function getTotalSpentPerSpecies() {
        return $this->birdModel->getTotalSpentPerSpecies();
    }

    public function getSpeciesGenderStats() {
        return $this->birdModel->getSpeciesGenderStats();
    }
}

