-- Create database
CREATE DATABASE IF NOT EXISTS job_portal_db;
USE job_portal_db;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    dob DATE NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    job_role VARCHAR(50) NOT NULL,
    salary DECIMAL(10,2) NOT NULL,
    degree VARCHAR(50) NOT NULL,
    university VARCHAR(100) NOT NULL,
    graduation YEAR NOT NULL,
    address TEXT NOT NULL,
    city VARCHAR(50) NOT NULL,
    pincode VARCHAR(10) NOT NULL,
    linkedin VARCHAR(255),
    hobbies TEXT,
    cv_path VARCHAR(255),
    certification_path VARCHAR(255),
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
