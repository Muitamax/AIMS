<?php
session_start();
if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'student') {
    header("Location: ../login.php");
    exit();
}

require_once("connect.php");

// Get student info from database
$student_info = null;
try {
    $stmt = $conn->prepare("SELECT * FROM students WHERE st_email = ?");
    $stmt->bind_param("s", $_SESSION['email']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $student_info = $result->fetch_assoc();
    }
    $stmt->close();
} catch (Exception $e) {
    // Error handling
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Dashboard - AIMS</title>
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
        .student-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
        .student-info h4 {
            color: #333;
            margin-bottom: 15px;
        }
        .student-info p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>🎓 AIMS - Student Dashboard</h1>
    <div class="navbar">
        <a href="index.php">🏠 Home</a>
        <a href="students.php">👥 Students</a>
        <a href="report.php">📊 My Report</a>
        <a href="account.php">👤 My Account</a>
        <a href="../logout.php">🚪 Logout</a>
    </div>
</div>

<div class="container">
    <!-- Welcome Section -->
    <div class="welcome-section">
        <h2>👋 Welcome back, <?= htmlspecialchars($_SESSION['fname'] ?? $_SESSION['username']) ?>!</h2>
        <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['email']) ?></p>
        <p><strong>Role:</strong> Student</p>
        <p>Access your attendance records, view reports, and manage your account information.</p>
        
        <?php if ($student_info): ?>
        <div class="student-info">
            <h4>📋 Your Information</h4>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Student ID:</strong> <?= htmlspecialchars($student_info['st_id']) ?></p>
                    <p><strong>Department:</strong> <?= htmlspecialchars($student_info['st_dept']) ?></p>
                    <p><strong>Batch:</strong> <?= htmlspecialchars($student_info['st_batch']) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Semester:</strong> <?= htmlspecialchars($student_info['st_sem']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($student_info['st_email']) ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Quick Actions -->
    <div class="welcome-section">
        <h3>🚀 Quick Actions</h3>
        <div class="quick-actions">
            <a href="report.php">📊 View Attendance Report</a>
            <a href="account.php">👤 Update My Account</a>
            <a href="students.php">👥 View Classmates</a>
            <a href="../logout.php">🚪 Logout</a>
        </div>
    </div>

    <!-- Footer -->
    <div style="text-align: center; margin-top: 40px; color: #666;">
        <p>&copy; 2024 AIMS - Online Attendance Management System</p>
        <p>Logged in as: <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>
    </div>
</div>

</body>
</html>