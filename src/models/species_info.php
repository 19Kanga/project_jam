<?php
class SpeciesInfo {
    private $conn;
    private $table = 'species_info';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all species information
    public function getAll() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch a single species by ID
    public function getById($id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create a new species record
    public function create($data) {
        $query = 'INSERT INTO ' . $this->table . ' (species_name, lifespan_years, clutch_size, avg_weight_kg, age_of_maturity_years, cites_status, endangered_status, world_population_estimated, eating_habits, egg_laying_season, habitat, behavior, additional_info, incubation_period_days, fledging_period_days, nest_type, breeding_season, preferred_climate, daily_food_requirement, predators, captive_breeding_success_rate, mortality_rate, diseases_common_health_issues, gestation_period_days, migration_pattern, conservation_actions, water_requirements, behavioral_traits, recommended_aviary_size, native_country)
                  VALUES (:species_name, :lifespan_years, :clutch_size, :avg_weight_kg, :age_of_maturity_years, :cites_status, :endangered_status, :world_population_estimated, :eating_habits, :egg_laying_season, :habitat, :behavior, :additional_info, :incubation_period_days, :fledging_period_days, :nest_type, :breeding_season, :preferred_climate, :daily_food_requirement, :predators, :captive_breeding_success_rate, :mortality_rate, :diseases_common_health_issues, :gestation_period_days, :migration_pattern, :conservation_actions, :water_requirements, :behavioral_traits, :recommended_aviary_size, :native_country)';
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    // Update an existing species record
    public function update($id, $data) {
        $query = 'UPDATE ' . $this->table . ' SET species_name = :species_name, lifespan_years = :lifespan_years, clutch_size = :clutch_size, avg_weight_kg = :avg_weight_kg, age_of_maturity_years = :age_of_maturity_years, cites_status = :cites_status, endangered_status = :endangered_status, world_population_estimated = :world_population_estimated, eating_habits = :eating_habits, egg_laying_season = :egg_laying_season, habitat = :habitat, behavior = :behavior, additional_info = :additional_info, incubation_period_days = :incubation_period_days, fledging_period_days = :fledging_period_days, nest_type = :nest_type, breeding_season = :breeding_season, preferred_climate = :preferred_climate, daily_food_requirement = :daily_food_requirement, predators = :predators, captive_breeding_success_rate = :captive_breeding_success_rate, mortality_rate = :mortality_rate, diseases_common_health_issues = :diseases_common_health_issues, gestation_period_days = :gestation_period_days, migration_pattern = :migration_pattern, conservation_actions = :conservation_actions, water_requirements = :water_requirements, behavioral_traits = :behavioral_traits, recommended_aviary_size = :recommended_aviary_size, native_country = :native_country WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        // Bind other parameters
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    // Delete a species record
    public function delete($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
