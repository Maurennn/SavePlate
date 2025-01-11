<?php
$host = 'localhost'; // Database host
$db = 'saveplate'; // Database name
$user = 'root'; // Database username, sesuaikan dengan kredensial Anda
$pass = ''; // Database password, sesuaikan jika ada password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $db :" . $e->getMessage());
}
?>
