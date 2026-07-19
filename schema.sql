CREATE DATABASE IF NOT EXISTS epigenia_cdss;
USE epigenia_cdss;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('Admin', 'Medical', 'Nutrition', 'Exercise', 'Patient') NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    date_of_birth DATE,
    gender ENUM('Male', 'Female', 'Other'),
    contact_number VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS blood_markers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT,
    marker_name VARCHAR(100) NOT NULL,
    marker_value DECIMAL(10,2) NOT NULL,
    unit VARCHAR(20),
    reference_range VARCHAR(50),
    recorded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS genetic_markers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT,
    snp VARCHAR(50) NOT NULL,
    gene VARCHAR(50),
    genotype VARCHAR(10),
    impact TEXT,
    recorded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS diet_plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT,
    professional_id INT,
    plan_details TEXT NOT NULL,
    calories_goal INT,
    phase ENUM('Cutting', 'Bulking', 'Maintenance', 'Adaptation'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE,
    FOREIGN KEY (professional_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS workout_plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT,
    professional_id INT,
    plan_details TEXT NOT NULL,
    focus VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE,
    FOREIGN KEY (professional_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS process_queue (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT,
    document_url VARCHAR(255),
    status ENUM('Pending', 'Processing', 'Completed', 'Failed') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT,
    amount DECIMAL(10,2) NOT NULL,
    payment_method ENUM('PIX', 'Credit Card', 'Crypto'),
    status ENUM('Pending', 'Completed', 'Failed', 'Refunded') DEFAULT 'Pending',
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE
);
