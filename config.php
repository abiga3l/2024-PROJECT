<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "harmony_hub";
$charset = 'utf8mb4';

// DSN for PDO
$dsn = "mysql:host=$servername;dbname=$database;charset=$charset";

// PDO options
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// MySQLi connection
$conn = new mysqli($servername, $username, $password, $database);

// Display errors for debugging (remove in production)
ini_set('display_errors', 'On');
error_reporting(E_ALL);

if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error, 3, 'errors.log');
    die("Connection failed: " . $conn->connect_error);
}

// Log successful connection (optional)
error_log("Database Connection Successful", 3, 'errors.log');
?>
