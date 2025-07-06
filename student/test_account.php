<?php
// Simple test for student account.php functionality
session_start();

// Simulate student session for testing
$_SESSION['type'] = 'student';
$_SESSION['username'] = 'testuser';
$_SESSION['email'] = 'test@example.com';
$_SESSION['fname'] = 'Test Student';

echo "<h2>Student Account Test</h2>";
echo "<p>Session Type: " . ($_SESSION['type'] ?? 'Not Set') . "</p>";
echo "<p>Username: " . ($_SESSION['username'] ?? 'Not Set') . "</p>";
echo "<p>Email: " . ($_SESSION['email'] ?? 'Not Set') . "</p>";

// Test database connection
require_once('connect.php');
if ($conn) {
    echo "<p>✅ Database connection successful</p>";
    
    // Test student query
    try {
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM students");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        echo "<p>✅ Students table accessible - " . $row['count'] . " records found</p>";
        $stmt->close();
    } catch (Exception $e) {
        echo "<p>❌ Error accessing students table: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>❌ Database connection failed</p>";
}

echo "<p><a href='account.php'>Test Account Page</a></p>";
echo "<p><a href='dashboard.php'>Test Dashboard</a></p>";
?>