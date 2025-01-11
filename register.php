<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging: Print the POST data (optional, you can remove this later)
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    
    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $confirm_password = $_POST['confirm-password'] ?? null;

    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([$name, $email, $hashed_password]);
        // Redirect to the login page after successful registration
        header("Location: login.html");
        exit(); // Make sure to call exit after header to stop further execution
    } catch (PDOException $e) {
        die("Could not register user: " . $e->getMessage());
    }
}
?>
