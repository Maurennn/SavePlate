<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
include 'db.php'; 

// Create a new instance of the Database class
$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm-password']);

    // Check if the passwords match
    if ($password !== $confirm_password) {
        echo "Error: Passwords do not match.";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists
    $checkEmailStmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
    $checkEmailStmt->bindParam(':email', $email);
    $checkEmailStmt->execute();

    if ($checkEmailStmt->rowCount() > 0) {
        echo "Error: Email already exists.";
    } else {
        // Prepare and bind the insert statement
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        // Execute the statement and check for success
        if ($stmt->execute()) {
            echo "Registration successful!";
            // Redirect to login page or home page
            header("Location: login.html");
            exit();
        } else {
            echo "Error: " . $stmt->errorInfo()[2]; // Show error message
        }
    }

    $checkEmailStmt = null;
    $stmt = null;
}
$conn = null; // Close the connection
?>