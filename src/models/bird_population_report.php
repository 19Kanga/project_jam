<?php
class BirdPopulationReport {
    private $conn;
    private $table = 'birds';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get birds grouped by species
    public function getBirdsGroupedBySpecies($filters = []) {
        $query = "SELECT species, COUNT(*) as total_birds FROM " . $this->table;
        $query .= $this->applyFilters($filters);
        $query .= " GROUP BY species";

        $stmt = $this->conn->prepare($query);
        $this->bindFilters($stmt, $filters);  // Bind filters to prevent SQL injection
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get birds grouped by gender for each species
    public function getBirdsGroupedByGender($filters = []) {
        $query = "SELECT species, gender, COUNT(*) as total_birds FROM " . $this->table;
        $query .= $this->applyFilters($filters);
        $query .= " GROUP BY species, gender";

        $stmt = $this->conn->prepare($query);
        $this->bindFilters($stmt, $filters);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Optional: Get birds grouped by age range
    public function getBirdsGroupedByAge($ageRange) {
        $query = "SELECT species, COUNT(*) as total_birds FROM " . $this->table;
        $query .= " WHERE TIMESTAMPDIFF(YEAR, hatched_date, CURDATE()) BETWEEN :min_age AND :max_age GROUP BY species";

        $stmt = $this->conn->prepare($query);
        list($minAge, $maxAge) = explode('-', $ageRange);
        $stmt->bindParam(':min_age', $minAge);
        $stmt->bindParam(':max_age', $maxAge);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Helper method to apply filters
    private function applyFilters($filters) {
        $filterString = " WHERE 1=1";
        if (!empty($filters['species'])) {
            $filterString .= " AND species = :species";
        }
        if (!empty($filters['gender'])) {
            $filterString .= " AND gender = :gender";
        }
        if (!empty($filters['age_range'])) {
            // Optionally add age filter if available
        }
        return $filterString;
    }

    // Helper method to bind filter values to the query
    private function bindFilters($stmt, $filters) {
        if (!empty($filters['species'])) {
            $stmt->bindParam(':species', $filters['species']);
        }
        if (!empty($filters['gender'])) {
            $stmt->bindParam(':gender', $filters['gender']);
        }
    }
}
?>
