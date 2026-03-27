<?php
// db.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "127.0.0.1"; // Works for both Ubuntu and XAMPP
$username = "root";        // Default username
$password = "";           // Blank password for easy sharing

// 1. Connect to MySQL FIRST (without selecting a database yet)
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Create the database if it doesn't exist on the teacher's computer
$sql_db = "CREATE DATABASE IF NOT EXISTS motoparts";
if ($conn->query($sql_db) === TRUE) {
    // 3. Select the database so we can use it
    $conn->select_db("motoparts");

    // 4. Create the 'users' table automatically if it doesn't exist
    $sql_table = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(100) NOT NULL,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->query($sql_table);
} else {
    die("Error creating database: " . $conn->error);
}
?>