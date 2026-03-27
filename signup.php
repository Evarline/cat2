<?php
// signup.php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Note: your HTML uses name="fullname", not "full_name"
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (full_name, username, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $fullname, $username, $email, $password);

    if ($stmt->execute()) {
        // After signup, send them back to index.html 
        // We add a "success" message in the URL so they know it worked
        header("Location: index.html?signup=success"); 
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>