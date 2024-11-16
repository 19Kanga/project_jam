<?php
require_once __DIR__ . '/../models/medical.php';
require_once __DIR__ . '/../config/database.php';

class MedicalReportController {
    private $medical;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->medical = new Medical($this->db);
    }

    // Get total medical expenses
    public function getTotalMedicalExpenses($startDate = null, $endDate = null) {
        return $this->medical->getTotalExpensesByDate($startDate, $endDate);
    }

    // Get detailed medical expenses
    public function getDetailedMedicalExpenses($startDate = null, $endDate = null) {
        return $this->medical->getDetailedExpensesByDate($startDate, $endDate);
    }
}
