<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['type'])) {
    header("Location: login.php");
    exit();
}

// Redirect based on user type
switch ($_SESSION['type']) {
    case 'admin':
        header("Location: admin/dashboard.php");
        break;
    case 'teacher':
        header("Location: teacher/dashboard.php");
        break;
    case 'student':
        header("Location: student/dashboard.php");
        break;
    default:
        header("Location: login.php");
        break;
}
exit();
?>