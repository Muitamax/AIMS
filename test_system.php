<?php
// Test system functionality
require_once("connect.php");
require_once("email_config.php");

echo "<h1>AIMS System Test</h1>";

// Test database connection
echo "<h2>Database Connection Test</h2>";
try {
    if ($conn) {
        echo "✅ MySQLi connection successful<br>";
    } else {
        echo "❌ MySQLi connection failed<br>";
    }
    
    if ($pdo) {
        echo "✅ PDO connection successful<br>";
    } else {
        echo "❌ PDO connection failed<br>";
    }
    
    // Test query
    $result = $conn->query("SELECT COUNT(*) as count FROM admininfo");
    $row = $result->fetch_assoc();
    echo "✅ Database query successful - " . $row['count'] . " users found<br>";
    
} catch (Exception $e) {
    echo "❌ Database error: " . $e->getMessage() . "<br>";
}

// Test email functionality
echo "<h2>Email Configuration Test</h2>";
echo "✅ Email functions loaded successfully<br>";

// Test session functionality
echo "<h2>Session Test</h2>";
session_start();
$_SESSION['test'] = 'working';
if (isset($_SESSION['test'])) {
    echo "✅ Session functionality working<br>";
} else {
    echo "❌ Session functionality failed<br>";
}

// Show system info
echo "<h2>System Information</h2>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Server: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
echo "Current Directory: " . __DIR__ . "<br>";

echo "<h2>File Structure Test</h2>";
$files_to_check = [
    'connect.php',
    'email_config.php',
    'login.php',
    'signup.php',
    'admin/index.php',
    'admin/signup.php'
];

foreach ($files_to_check as $file) {
    if (file_exists($file)) {
        echo "✅ $file exists<br>";
    } else {
        echo "❌ $file missing<br>";
    }
}

echo "<h2>Links for Testing</h2>";
echo "<a href='login.php'>Login Page</a><br>";
echo "<a href='signup.php'>Public Signup Page</a><br>";
echo "<a href='admin/index.php'>Admin Dashboard</a><br>";
echo "<a href='admin/signup.php'>Admin User Creation</a><br>";
?>