
<?php
$host = 'localhost';
$db = 'attsystem';
$user = 'root';
$pass = ''; // or your MySQL password

// PDO Connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Enable error reporting
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// MySQLi Connection (for compatibility)
try {
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>