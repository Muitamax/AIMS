<?php
// Database connection parameters
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "attsystem"; // ← Change this to your DB name

// Create connection using MySQLi

$conn = mysqli_connect("localhost", "root", "", "attsystem");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>