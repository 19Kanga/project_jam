<?php
require_once __DIR__ . '/../models/bird_population_report.php'; // Model for database queries
require_once __DIR__ . '/../helpers/export_helper.php';         // Helper for exporting data
require_once __DIR__ . '/../config/database.php';               // Database connection

class BirdPopulationReportController {
    private $birdReport;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->birdReport = new BirdPopulationReport($this->db);
    }

    // Get all birds grouped by species with filters
    public function getBirdsBySpecies($filters = []) {
        return $this->birdReport->getBirdsGroupedBySpecies($filters);
    }

    // Get bird count by gender for each species
    public function getBirdsByGender($filters = []) {
        return $this->birdReport->getBirdsGroupedByGender($filters);
    }

    // Handle CSV export of bird population data
    public function exportToCSV($filters = []) {
        $data = $this->getBirdsBySpecies($filters);
        exportCSV('bird_population_report.csv', $data);
    }

    // Handle PDF export of bird population data
    public function exportToPDF($filters = []) {
        $data = $this->getBirdsBySpecies($filters);
        exportPDF('bird_population_report.pdf', $data);
    }
}
