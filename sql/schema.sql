CREATE DATABASE nadsoft;
USE nadsoft;
CREATE TABLE members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    username VARCHAR(100),
    email VARCHAR(100),
    address TEXT,
    address2 TEXT,
    country VARCHAR(50),
    state VARCHAR(50),
    zip VARCHAR(20),
    payment_method VARCHAR(50),
    card_name VARCHAR(100),
    card_number VARCHAR(30),
    card_expiration VARCHAR(10),
    card_cvv VARCHAR(10),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE member_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT,
    product VARCHAR(100),
    price INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE
);
