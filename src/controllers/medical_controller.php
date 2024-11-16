<?php
require_once __DIR__ . '/../models/medical.php';
require_once __DIR__ . '/../config/database.php';

class MedicalController {
    private $db;
    private $medical;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->medical = new Medical($this->db);
    }

    // Fetch all medical records
    public function getAllMedical() {
        return $this->medical->getAll();
    }

    // Get total medical expenses
    // Add a new medical record
    public function addMedical($data) {
        $result = $this->medical->create($data);
        if ($result) {
            header('Location: ../../public/views/medical.php');
            exit(); 
        } else {
            echo "Error adding medical record.";
        }
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