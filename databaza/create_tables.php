<?php
include 'db_connect.php';

// Ensure $conn is the variable name used in db_connect.php
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Array of SQL statements to execute
$sqlStatements = [
    // Create users table
    "CREATE TABLE IF NOT EXISTS users (
        id SERIAL PRIMARY KEY,
        firstName VARCHAR(50) NOT NULL,
        lastName VARCHAR(50) NOT NULL,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        pass VARCHAR(255) NOT NULL
    );",

    // Create password_resets table for password reset functionality
    "CREATE TABLE IF NOT EXISTS password_resets (
        id SERIAL PRIMARY KEY,
        email VARCHAR(100) NOT NULL,
        code VARCHAR(6) NOT NULL CHECK (code ~ '^[0-9]{6}$'),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        expires_at TIMESTAMP NOT NULL,
        CONSTRAINT fk_email FOREIGN KEY (email) REFERENCES users(email) ON DELETE CASCADE
    );",

    // Create main pets table for common attributes without enums
    "CREATE TABLE IF NOT EXISTS pets (
        id SERIAL PRIMARY KEY,
        type VARCHAR(20) NOT NULL CHECK (type IN ('Dog', 'Cat', 'Rabbit', 'Bird')),
        name VARCHAR(50) NOT NULL,
        age INT NOT NULL CHECK (age >= 0),
        gender VARCHAR(20) NOT NULL CHECK (gender IN ('Male', 'Female', 'Unknown')),
        color VARCHAR(30) NOT NULL,
        personality TEXT NOT NULL,
        image VARCHAR(255) NOT NULL
    );",

    // Create table for Dog-specific attributes
    "CREATE TABLE IF NOT EXISTS dogs (
        pet_id INT PRIMARY KEY,
        breed VARCHAR(50) NOT NULL,
        house_trained BOOLEAN NOT NULL,
        CONSTRAINT fk_pet FOREIGN KEY (pet_id) REFERENCES pets(id) ON DELETE CASCADE
    );",

    // Create table for Cat-specific attributes
    "CREATE TABLE IF NOT EXISTS cats (
        pet_id INT PRIMARY KEY,
        breed VARCHAR(50) NOT NULL,
        litter_trained BOOLEAN NOT NULL,
        health TEXT NOT NULL,
        CONSTRAINT fk_pet FOREIGN KEY (pet_id) REFERENCES pets(id) ON DELETE CASCADE
    );",

    // Create table for Rabbit-specific attributes
    "CREATE TABLE IF NOT EXISTS rabbits (
        pet_id INT PRIMARY KEY,
        breed VARCHAR(50) NOT NULL,
        house_trained BOOLEAN NOT NULL,
        health TEXT NOT NULL,
        CONSTRAINT fk_pet FOREIGN KEY (pet_id) REFERENCES pets(id) ON DELETE CASCADE
    );",

    // Create table for Bird-specific attributes
    "CREATE TABLE IF NOT EXISTS birds (
        pet_id INT PRIMARY KEY,
        species VARCHAR(50) NOT NULL,
        health TEXT NOT NULL,
        wingspan INT NOT NULL CHECK (wingspan >= 0),
        CONSTRAINT fk_pet FOREIGN KEY (pet_id) REFERENCES pets(id) ON DELETE CASCADE
    );",
     "CREATE TABLE IF NOT EXISTS adopted_pets (
    id SERIAL PRIMARY KEY,
    pet_id INT NOT NULL UNIQUE,
    user_id INT NOT NULL,
    adoption_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pet_id) REFERENCES pets(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);", 

    // Create donation table
    "CREATE TABLE IF NOT EXISTS donation (
        id SERIAL PRIMARY KEY,
        donation_type VARCHAR(100) NOT NULL,
        amount NUMERIC(10, 2) NOT NULL,
        donation_date DATE NOT NULL
    );",
    "CREATE TABLE IF NOT EXISTS wishlist (
    user_id INT NOT NULL,
    pet_id INT NOT NULL,
    added_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, pet_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (pet_id) REFERENCES pets(id) ON DELETE CASCADE
);"
];

// Execute each SQL statement and handle errors
foreach ($sqlStatements as $sql) {
    $result = pg_query($conn, $sql);
    if ($result) {
        // Extract the table name from the SQL for feedback
        preg_match("/CREATE TABLE IF NOT EXISTS (\w+)/i", $sql, $matches);
        $name = $matches[1] ?? 'unknown';
        echo "Successfully created $name<br>";
    } else {
        echo "Error creating table: " . pg_last_error($conn) . "<br>";
    }
}

// Close the database connection
pg_close($conn);
?>