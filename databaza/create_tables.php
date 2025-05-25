<?php
include 'db_connect.php';

// Ensure $conn is the variable name used in db_connect.php
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Array of SQL statements to execute
$sqlStatements = [
    // No need to drop enum types since we're not using them

    // Create users table (your existing table)
    "CREATE TABLE IF NOT EXISTS users (
        id SERIAL PRIMARY KEY,
        firstName VARCHAR(50) NOT NULL,
        lastName VARCHAR(50) NOT NULL,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        pass VARCHAR(255) NOT NULL
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
    );" , 
    "CREATE TABLE IF NOT EXISTS donation (
        id SERIAL PRIMARY KEY,
        donation_type VARCHAR(100) NOT NULL,
        amount NUMERIC(10, 2) NOT NULL,
        donation_date DATE NOT NULL
    );"
];

// Execute each SQL statement and handle errors
 foreach ($sqlStatements as $sql){
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