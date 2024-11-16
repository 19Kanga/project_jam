<?php
require_once __DIR__ . '/../models/species_info.php';
require_once __DIR__ . '/../config/database.php';

class SpeciesInfoController {
    private $db;
    private $speciesInfo;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->speciesInfo = new SpeciesInfo($this->db);
    }

    // Get all species information
    public function getAllSpeciesInfo() {
        return $this->speciesInfo->getAll();
    }

    // Get species by ID
    public function getSpeciesInfoById($id) {
        return $this->speciesInfo->getById($id);
    }

    // Create a new species record
    public function createSpeciesInfo($data) {
        return $this->speciesInfo->create($data);
    }

    // Update a species record
    public function updateSpeciesInfo($id, $data) {
        return $this->speciesInfo->update($id, $data);
    }

    // Delete a species record
    public function deleteSpeciesInfo($id) {
        return $this->speciesInfo->delete($id);
    }
}
?>
