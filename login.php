<?php
// login.php
session_start(); // Start a session to remember the user is logged in
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Search for the user by email
    $stmt = $conn->prepare("SELECT id, full_name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Verify the typed password matches the secured password in the database
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['full_name'];
            
            // Redirect the user to the main site
            header("Location: index.html#categories"); 
            exit();
        } else {
            echo "Incorrect password. <a href='index.html'>Try again</a>";
        }
    } else {
        echo "No account found with that email. <a href='index.html'>Try again</a>";
    }

    $stmt->close();
    $conn->close();
}
?>