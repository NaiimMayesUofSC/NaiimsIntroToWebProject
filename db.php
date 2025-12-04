<?php
// db.php - single place for DB connection
$DB_HOST = '127.0.0.1';   // or 'localhost'
$DB_USER = 'root';
$DB_PASS = '';            // default XAMPP MySQL root has no password
$DB_NAME = 'fanzone';     // use the DB name you created

// Create connection (mysqli)
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// Check connection
if ($conn->connect_error) {
    // For dev only: display message. In production log it instead.
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>
