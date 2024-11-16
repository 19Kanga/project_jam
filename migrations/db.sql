-- Birds table
CREATE TABLE birds (
    id INT AUTO_INCREMENT PRIMARY KEY,
    species VARCHAR(255),
    gender VARCHAR(50),
    purchase_date DATE,
    purchase_cost DECIMAL(10,2),
    purchased_from VARCHAR(255),
    weight_at_purchase DECIMAL(5,2),
    age_at_purchase INT,
    hatched_date DATE,
    remark TEXT,
    breeding_at_purchase BOOLEAN,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Breeding records table
CREATE TABLE breeding (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bird_id INT,
    partner_id INT,
    breeding_date DATE,
    success_rate DECIMAL(5,2),
    FOREIGN KEY (bird_id) REFERENCES birds(id) ON DELETE CASCADE,
    FOREIGN KEY (partner_id) REFERENCES birds(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Feeding schedule table
CREATE TABLE feeding (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bird_id INT,
    feeding_time TIME,
    food_type VARCHAR(255),
    quantity DECIMAL(5,2),
    feeding_frequency VARCHAR(255),  -- e.g., daily, weekly
    FOREIGN KEY (bird_id) REFERENCES birds(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Medical records table
CREATE TABLE medical_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bird_id INT,
    checkup_date DATE,
    treatment VARCHAR(255),
    notes TEXT,
    next_checkup_date DATE,  -- For tracking future medical checkups
    FOREIGN KEY (bird_id) REFERENCES birds(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Sales records table
CREATE TABLE sales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bird_id INT,
    sale_date DATE,
    sale_price DECIMAL(10,2),
    customer_name VARCHAR(255),
    customer_contact VARCHAR(255),
    sale_notes TEXT,  -- To track any sale-specific remarks
    FOREIGN KEY (bird_id) REFERENCES birds(id) ON DELETE SET NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Environment monitoring table
CREATE TABLE environment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    measurement_date DATE,
    temperature DECIMAL(5,2),
    humidity DECIMAL(5,2),
    aviary_location VARCHAR(255),
    notes TEXT,  -- For logging specific environmental conditions
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- User management table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    role VARCHAR(50),
    email VARCHAR(255),  -- Added for email notifications
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Genealogy tracking table (for birds' family tree)
CREATE TABLE genealogy (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bird_id INT,
    parent_id INT,
    FOREIGN KEY (bird_id) REFERENCES birds(id) ON DELETE CASCADE,
    FOREIGN KEY (parent_id) REFERENCES birds(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Alerts and notifications table
CREATE TABLE alerts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    alert_type VARCHAR(255),  -- e.g., 'Feeding', 'Medical Checkup'
    alert_message TEXT,
    alert_date DATE,
    status VARCHAR(50),  -- e.g., 'Pending', 'Completed'
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Inventory management table (e.g., food, medical supplies)
CREATE TABLE inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(255),
    quantity INT,
    supplier VARCHAR(255),
    purchase_date DATE,
    expiry_date DATE,  -- For tracking when supplies expire
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Vaccination records table
CREATE TABLE vaccination_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bird_id INT,
    vaccine_name VARCHAR(255),
    vaccination_date DATE,
    next_due_date DATE,  -- For future vaccine reminders
    FOREIGN KEY (bird_id) REFERENCES birds(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Expenses tracking table (for financial management)
CREATE TABLE expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT,
    amount DECIMAL(10,2),
    expense_date DATE,
    category VARCHAR(255),  -- e.g., 'Feeding', 'Medical', 'Breeding'
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Customers table (for managing customer details and purchase history)
CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    contact_info VARCHAR(255),
    address TEXT,
    purchase_history TEXT,  -- Could reference sales or provide a summary
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Activity logs table (for tracking user activities)
CREATE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(255),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
