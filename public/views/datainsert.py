import pandas as pd

# Load your bird dataset from a CSV or Excel file
file_path = 'filled_bird_list_with_dummy_data.csv'  # or 'path_to_your_file.xlsx'
df = pd.read_csv(file_path)  # For CSV files, use pd.read_excel(file_path) for Excel files

# Function to generate SQL insert statement for each row
def generate_sql_insert(row):
    sql = f"""
    INSERT INTO birds (species, subspecies, gender, purchase_date, purchase_cost, purchased_from, weight_at_purchase, age_at_purchase, hatched_date, remark, breeding_at_purchase) 
    VALUES ('{row['Bird species']}', '{row['Subspecies']}', '{row['Gender']}', '{row['Purchase Date']}', {row['Purchase Cost']}, '{row['Purchased From']}', {row['Weight at Purchase']}, {row['Age at Purchase']}, '{row['Hatched Date']}', '{row['Remark']}', '{row['Breeding at Purchase']}');
    """
    return sql

# Apply the function to each row in the DataFrame and generate SQL statements
sql_statements = df.apply(generate_sql_insert, axis=1)

# Save the SQL statements to a file
output_sql_file = 'bird_insert_statements.sql'
with open(output_sql_file, 'w') as f:
    f.write("\n".join(sql_statements))

print(f"SQL insert statements saved to {output_sql_file}")
