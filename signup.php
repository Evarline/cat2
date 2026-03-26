<?php
// signup.php
require 'db.php'; // Bring in the database connection

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Secure the password using hashing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement to prevent hackers from injecting malicious code
    $stmt = $conn->prepare("INSERT INTO users (full_name, username, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $full_name, $username, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "Account created successfully! <a href='index.html'>Go back to Login</a>";
    } else {
        echo "Error: That email or username might already be taken.";
    }

    $stmt->close();
    $conn->close();
}
?>