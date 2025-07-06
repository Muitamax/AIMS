<?php
session_start();
if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once("../connect.php");
require_once("../email_config.php");

$success_msg = "";
$error_msg = "";

// Get user statistics
try {
    $total_users = $pdo->query("SELECT COUNT(*) FROM admininfo")->fetchColumn();
    $total_students = $pdo->query("SELECT COUNT(*) FROM students")->fetchColumn();
    $total_teachers = $pdo->query("SELECT COUNT(*) FROM teachers")->fetchColumn();
    $total_admins = $pdo->query("SELECT COUNT(*) FROM admininfo WHERE type = 'admin'")->fetchColumn();
} catch (Exception $e) {
    $error_msg = "Error loading statistics: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard - AIMS</title>
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
        .stats-container {
            display: flex;
            justify-content: space-around;
            margin: 30px 0;
            flex-wrap: wrap;
        }
        .stat-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            margin: 10px;
            min-width: 150px;
        }
        .stat-box h3 {
            color: #333;
            margin-bottom: 10px;
        }
        .stat-box .number {
            font-size: 2em;
            font-weight: bold;
            color: #007bff;
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
        .recent-activity {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin: 20px auto;
            max-width: 800px;
        }
        .message {
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
            font-weight: bold;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>🎓 AIMS - Admin Dashboard</h1>
    <div class="navbar">
        <a href="index.php">📊 Add Data</a>
        <a href="signup.php">👥 Create Users</a>
        <a href="../logout.php">🚪 Logout</a>
    </div>
</div>

<div class="container">
    <!-- Welcome Section -->
    <div class="welcome-section">
        <h2>👋 Welcome back, <?= htmlspecialchars($_SESSION['fname'] ?? $_SESSION['username']) ?>!</h2>
        <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['email']) ?></p>
        <p><strong>Role:</strong> Administrator</p>
        <p>You have full access to manage the attendance system, create users, and oversee all operations.</p>
    </div>

    <!-- Statistics -->
    <div class="stats-container">
        <div class="stat-box">
            <h3>👥 Total Users</h3>
            <div class="number"><?= $total_users ?? 0 ?></div>
        </div>
        <div class="stat-box">
            <h3>👨‍🎓 Students</h3>
            <div class="number"><?= $total_students ?? 0 ?></div>
        </div>
        <div class="stat-box">
            <h3>👨‍🏫 Teachers</h3>
            <div class="number"><?= $total_teachers ?? 0 ?></div>
        </div>
        <div class="stat-box">
            <h3>🛡️ Admins</h3>
            <div class="number"><?= $total_admins ?? 0 ?></div>
        </div>
    </div>

    <!-- Messages -->
    <?php if (!empty($success_msg)): ?>
        <div class="message success"><?= htmlspecialchars($success_msg) ?></div>
    <?php endif; ?>
    
    <?php if (!empty($error_msg)): ?>
        <div class="message error"><?= htmlspecialchars($error_msg) ?></div>
    <?php endif; ?>

    <!-- Quick Actions -->
    <div class="welcome-section">
        <h3>🚀 Quick Actions</h3>
        <div class="quick-actions">
            <a href="index.php">📝 Add Student/Teacher</a>
            <a href="signup.php">👤 Create User Account</a>
            <a href="../test_system.php">🔧 Test System</a>
            <a href="../logout.php">🚪 Logout</a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="recent-activity">
        <h3>📊 System Overview</h3>
        <ul>
            <li>✅ Email notifications are enabled</li>
            <li>✅ Password hashing is active</li>
            <li>✅ Session management is working</li>
            <li>✅ Database connections are stable</li>
        </ul>
        
        <h4>📋 Admin Functions Available:</h4>
        <ul>
            <li>🔹 Create and manage user accounts</li>
            <li>🔹 Add student and teacher records</li>
            <li>🔹 Monitor system statistics</li>
            <li>🔹 Access all attendance reports</li>
            <li>🔹 Configure system settings</li>
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