import mysql.connector
import csv

# MySQL database connection details
db_config = {
    'host': 'localhost',  # Change to your MySQL server host
    'user': 'root',  # Your MySQL username
    'password': '',  # Your MySQL password
    'database': 'avs'  # Your database name
}

# CSV file path
csv_file_path = 'species__info.csv'  # Provide the correct CSV file path

# Connect to the MySQL database
try:
    connection = mysql.connector.connect(**db_config)
    cursor = connection.cursor()

    # Open the CSV file
    with open(csv_file_path, newline='', encoding='utf-8') as csvfile:
        csv_reader = csv.reader(csvfile)
        next(csv_reader)  # Skip the header row

        # Prepare the insert query (ensure all 30 columns from species_info are matched)
        insert_query = """
        INSERT INTO species_info (species_name, lifespan_years, clutch_size, avg_weight_kg, 
                                  age_of_maturity_years, cites_status, endangered_status, world_population_estimated, 
                                  eating_habits, egg_laying_season, habitat, behavior, additional_info, incubation_period_days, 
                                  fledging_period_days, nest_type, breeding_season, preferred_climate, daily_food_requirement, 
                                  predators, captive_breeding_success_rate, mortality_rate, diseases_common_health_issues, 
                                  gestation_period_days, migration_pattern, conservation_actions, water_requirements, 
                                  behavioral_traits, recommended_aviary_size, native_country)
        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
        """

        # Insert rows into the table
        for row in csv_reader:
            # Verify the column count matches the expected number of columns (30 in this case)
            if len(row) != 30:
                print(f"Skipping row due to mismatch in column count: {row}")
                continue  # Skip rows that don't have the correct number of columns
            
            # Execute the insert query
            cursor.execute(insert_query, row)
        
        # Commit the transaction
        connection.commit()
        print(f"{cursor.rowcount} rows inserted successfully.")
    
except mysql.connector.Error as err:
    print(f"Error: {err}")
finally:
    if connection.is_connected():
        cursor.close()
        connection.close()
        print("MySQL connection is closed.")