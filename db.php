<?php
// db.php
$servername = "localhost";
$username = "root"; // Default username for local servers
$password = "";     // Default password is usually blank
$dbname = "motoparts";

// Create the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if it worked
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>