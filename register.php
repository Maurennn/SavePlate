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
        header("Location: login.php");
        exit(); // Make sure to call exit after header to stop further execution
    } catch (PDOException $e) {
        die("Could not register user: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SavePlate</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section id="register">

        <form action="register.php" method="POST">
            <div class="form-group">
                <h1>Register</h1>
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Your Name" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Your Email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Your Password" required>
                </div>
                <div class="input-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Your Password" required>
                </div>
                <button class="btn">Register</button>
            </div>
            <p>
                <span style="color: black;">Already have an account?</span> 
                <a href="login.php" style="color: #2348dd;">Login here</a>
            </p>
        </form>
</body>
</html>

