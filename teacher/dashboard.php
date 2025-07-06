<?php
session_start();
if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'teacher') {
    header("Location: ../login.php");
    exit();
}

require_once("connect.php");

// Get some basic statistics
$total_students = 0;
$total_courses = 0;
try {
    $result = $conn->query("SELECT COUNT(*) as count FROM students");
    $row = $result->fetch_assoc();
    $total_students = $row['count'];
    
    $result = $conn->query("SELECT COUNT(DISTINCT course) as count FROM attendance");
    $row = $result->fetch_assoc();
    $total_courses = $row['count'];
} catch (Exception $e) {
    // Handle error silently
}

// Check for email notification status
$email_status = $_SESSION['email_notification'] ?? null;
unset($_SESSION['email_notification']); // Clear after showing
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Teacher Dashboard - AIMS</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            text-align: center;
        }
        .navbar {
            background-color: rgba(255,255,255,0.1);
            padding: 10px 0;
            text-align: center;
            margin-top: 15px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            padding: 8px 16px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .navbar a:hover {
            background-color: rgba(255,255,255,0.2);
            text-decoration: none;
            color: white;
        }
        .welcome-section {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin: 20px auto;
            max-width: 800px;
        }
        .quick-actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        .quick-actions a {
            background: #007bff;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .quick-actions a:hover {
            background: #0056b3;
            text-decoration: none;
            color: white;
        }
        .stats-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
            text-align: center;
        }
        .stats-box h4 {
            margin: 0 0 10px 0;
            color: #333;
        }
        .stats-box .number {
            font-size: 2em;
            font-weight: bold;
            color: #007bff;
        }
        .email-notification {
            padding: 10px;
            margin: 15px 0;
            border-radius: 5px;
            text-align: center;
        }
        .email-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .email-warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>👨‍🏫 AIMS - Teacher Dashboard</h1>
    <div class="navbar">
        <a href="index.php">🏠 Home</a>
        <a href="students.php">👥 Students</a>
        <a href="attendance.php">📝 Attendance</a>
        <a href="report.php">📊 Reports</a>
        <a href="../logout.php">🚪 Logout</a>
    </div>
</div>

<div class="container">
    <!-- Email Notification Status -->
    <?php if ($email_status === 'sent'): ?>
        <div class="email-notification email-success">
            📧 Login notification email sent successfully!
        </div>
    <?php elseif ($email_status === 'failed'): ?>
        <div class="email-notification email-warning">
            ⚠️ Login notification email could not be sent (system issue), but you're logged in successfully.
        </div>
    <?php endif; ?>

    <!-- Welcome Section -->
    <div class="welcome-section">
        <h2>👋 Welcome back, <?= htmlspecialchars($_SESSION['fname'] ?? $_SESSION['username']) ?>!</h2>
        <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['email']) ?></p>
        <p><strong>Role:</strong> Teacher</p>
        <p>Manage student attendance, view reports, and track academic progress.</p>
        
        <div class="row">
            <div class="col-md-6">
                <div class="stats-box">
                    <h4>👥 Total Students</h4>
                    <div class="number"><?= $total_students ?></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stats-box">
                    <h4>📚 Courses</h4>
                    <div class="number"><?= $total_courses ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="welcome-section">
        <h3>🚀 Quick Actions</h3>
        <div class="quick-actions">
            <a href="attendance.php">📝 Record Attendance</a>
            <a href="report.php">📊 View Reports</a>
            <a href="students.php">👥 View Students</a>
            <a href="../logout.php">🚪 Logout</a>
        </div>
    </div>

    <!-- Instructions -->
    <div class="welcome-section">
        <h3>📋 Instructions</h3>
        <ul>
            <li>📝 Use <strong>Attendance</strong> to record daily student attendance</li>
            <li>📊 Use <strong>Reports</strong> to view attendance statistics</li>
            <li>👥 Use <strong>Students</strong> to view student information</li>
            <li>🔧 Contact admin if you need help with any features</li>
        </ul>
    </div>

    <!-- Footer -->
    <div style="text-align: center; margin-top: 40px; color: #666;">
        <p>&copy; 2024 AIMS - Online Attendance Management System</p>
        <p>Logged in as: <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>
    </div>
</div>

</body>
</html>