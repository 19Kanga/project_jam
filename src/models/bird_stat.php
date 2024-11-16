<?php

class BirdModel {
    private $conn;
    private $table = 'birds';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get total birds bought per year
    public function getBirdsBoughtPerYear() {
        $query = "SELECT YEAR(purchase_date) AS year, COUNT(*) AS total_birds_bought
                  FROM " . $this->table . " 
                  GROUP BY YEAR(purchase_date)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get gender-wise total bird count
    public function getBirdCountByGender() {
        $query = "SELECT gender, COUNT(*) AS total_gender
                  FROM " . $this->table . " 
                  GROUP BY gender";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get species-wise male/female bird count
    public function getSpeciesGenderCount() {
        $query = "SELECT species, gender, COUNT(*) AS total_birds
                  FROM " . $this->table . " 
                  GROUP BY species, gender";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get total spent on birds per year
    public function getTotalSpentPerYear() {
        $query = "SELECT YEAR(purchase_date) AS year, SUM(purchase_cost) AS total_spent
                  FROM " . $this->table . " 
                  GROUP BY YEAR(purchase_date)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get total spent per species
    public function getTotalSpentPerSpecies() {
        $query = "SELECT species, SUM(purchase_cost) AS total_spent
                  FROM " . $this->table . " 
                  GROUP BY species";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get total stats for species, gender, and amount spent
    public function getSpeciesGenderStats() {
        $query = "SELECT species, gender, COUNT(*) AS total_birds, SUM(purchase_cost) AS total_spent
                  FROM " . $this->table . " 
                  GROUP BY species, gender";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

