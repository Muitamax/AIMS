<?php
require_once('email_config.php');

$test_result = "";
$test_type = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $test_email = $_POST['test_email'];
    $test_name = $_POST['test_name'] ?? 'Test User';
    $test_username = $_POST['test_username'] ?? 'testuser';
    $test_type = $_POST['test_type'];
    
    switch ($test_type) {
        case 'basic':
            $result = sendEmail($test_email, "AIMS Test Email", "This is a test message from AIMS system. Time: " . date('Y-m-d H:i:s'));
            $test_result = $result ? "✅ Basic email sent successfully!" : "❌ Basic email failed to send.";
            break;
            
        case 'welcome':
            $result = sendWelcomeEmail($test_email, $test_name, $test_username, 'student');
            $test_result = $result ? "✅ Welcome email sent successfully!" : "❌ Welcome email failed to send.";
            break;
            
        case 'login':
            $result = sendLoginNotification($test_email, $test_name);
            $test_result = $result ? "✅ Login notification sent successfully!" : "❌ Login notification failed to send.";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Email Test Form - AIMS</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .result {
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
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="email"], input[type="text"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .btn {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background: #0056b3;
        }
        .info-box {
            background: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📧 AIMS Email Test Form</h2>
    
    <div class="info-box">
        <h4>ℹ️ Email Test Information</h4>
        <p>Use this form to test email functionality. Enter a real email address to receive test emails.</p>
        <p><strong>Note:</strong> Make sure your server has email/SMTP configured to send emails.</p>
    </div>

    <?php if (!empty($test_result)): ?>
        <div class="result <?= strpos($test_result, '✅') !== false ? 'success' : 'error' ?>">
            <?= $test_result ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="test_email">Email Address:</label>
            <input type="email" id="test_email" name="test_email" required 
                   placeholder="Enter your email address" 
                   value="<?= htmlspecialchars($_POST['test_email'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="test_name">Test Name:</label>
            <input type="text" id="test_name" name="test_name" 
                   placeholder="Enter test name" 
                   value="<?= htmlspecialchars($_POST['test_name'] ?? 'Test User') ?>">
        </div>

        <div class="form-group">
            <label for="test_username">Test Username:</label>
            <input type="text" id="test_username" name="test_username" 
                   placeholder="Enter test username" 
                   value="<?= htmlspecialchars($_POST['test_username'] ?? 'testuser') ?>">
        </div>

        <div class="form-group">
            <label for="test_type">Email Type:</label>
            <select id="test_type" name="test_type" required>
                <option value="">Select email type to test</option>
                <option value="basic" <?= ($test_type == 'basic') ? 'selected' : '' ?>>Basic Test Email</option>
                <option value="welcome" <?= ($test_type == 'welcome') ? 'selected' : '' ?>>Welcome Email</option>
                <option value="login" <?= ($test_type == 'login') ? 'selected' : '' ?>>Login Notification</option>
            </select>
        </div>

        <button type="submit" class="btn">📧 Send Test Email</button>
    </form>

    <div style="margin-top: 30px;">
        <h4>📋 Email Types Explained:</h4>
        <ul>
            <li><strong>Basic Test Email:</strong> Simple test message to verify email functionality</li>
            <li><strong>Welcome Email:</strong> HTML email sent when new accounts are created</li>
            <li><strong>Login Notification:</strong> Email sent when users log in to the system</li>
        </ul>
    </div>

    <div style="margin-top: 20px; text-align: center;">
        <a href="test_email.php" class="btn" style="background: #6c757d; text-decoration: none;">🔧 Technical Email Test</a>
        <a href="index.php" class="btn" style="background: #28a745; text-decoration: none;">🏠 Back to Main Page</a>
    </div>
</div>

</body>
</html>