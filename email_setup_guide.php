<?php
// Email Setup Guide for AIMS
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Email Setup Guide - AIMS</title>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; }
        .step { background: #e9ecef; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .code { background: #f8f9fa; padding: 10px; border-radius: 3px; font-family: monospace; }
        .important { background: #fff3cd; border: 1px solid #ffeeba; padding: 10px; border-radius: 5px; }
        .success { background: #d4edda; border: 1px solid #c3e6cb; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>

<div class="container">
    <h1>📧 Email Setup Guide for AIMS</h1>
    
    <div class="important">
        <h3>⚠️ Important: Configure Your Email Address</h3>
        <p>You need to set up your actual email address for the system to send emails.</p>
    </div>

    <div class="step">
        <h3>Step 1: Configure From Email</h3>
        <p>Edit the file: <code>AIMS/email_config.php</code></p>
        <div class="code">
$email_config = [<br>
&nbsp;&nbsp;&nbsp;&nbsp;'from_email' => '<strong>your-email@gmail.com</strong>',  // 👈 Change this<br>
&nbsp;&nbsp;&nbsp;&nbsp;'from_name' => 'AIMS - Online Attendance Management System',<br>
&nbsp;&nbsp;&nbsp;&nbsp;'reply_to' => '<strong>your-email@gmail.com</strong>'   // 👈 Change this<br>
];
        </div>
    </div>

    <div class="step">
        <h3>Step 2: Recipient Emails (Automatic)</h3>
        <p>Recipient emails are automatically taken from:</p>
        <ul>
            <li><strong>Signup:</strong> User's email from signup form</li>
            <li><strong>Login:</strong> User's email from database</li>
            <li><strong>Students:</strong> Student email from students table</li>
            <li><strong>Teachers:</strong> Teacher email from database</li>
        </ul>
    </div>

    <div class="step">
        <h3>Step 3: Test Your Email Setup</h3>
        <p>Use these tools to test your email configuration:</p>
        <div style="display: flex; gap: 10px; margin-top: 10px;">
            <a href="email_test_form.php" style="background: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">📧 Send Test Email</a>
            <a href="email_debug.php" style="background: #fd7e14; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">🐛 Debug Config</a>
            <a href="test_email.php" style="background: #6c757d; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">🔧 Technical Test</a>
        </div>
    </div>

    <div class="step">
        <h3>Step 4: Test Real Workflow</h3>
        <ol>
            <li><strong>Create Account:</strong> <a href="signup.php">Sign up</a> with your real email</li>
            <li><strong>Check Email:</strong> Look for welcome email in your inbox</li>
            <li><strong>Login:</strong> <a href="login.php">Login</a> with your account</li>
            <li><strong>Check Email:</strong> Look for login notification email</li>
        </ol>
    </div>

    <div class="success">
        <h3>✅ Example Configuration</h3>
        <p>Here's what your email_config.php should look like:</p>
        <div class="code">
$email_config = [<br>
&nbsp;&nbsp;&nbsp;&nbsp;'from_email' => 'myemail@gmail.com',<br>
&nbsp;&nbsp;&nbsp;&nbsp;'from_name' => 'AIMS - Online Attendance Management System',<br>
&nbsp;&nbsp;&nbsp;&nbsp;'reply_to' => 'myemail@gmail.com'<br>
];
        </div>
    </div>

    <div class="step">
        <h3>🔧 Server Configuration (If Emails Don't Work)</h3>
        <p>If emails are not sending, you may need to configure your server:</p>
        
        <h4>For Linux/Ubuntu:</h4>
        <div class="code">
sudo apt-get install sendmail<br>
sudo service sendmail start
        </div>
        
        <h4>For XAMPP:</h4>
        <ul>
            <li>Open XAMPP Control Panel</li>
            <li>Configure sendmail settings</li>
            <li>Or use Gmail SMTP configuration</li>
        </ul>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <a href="index.php" style="background: #007bff; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px;">🏠 Back to Main Page</a>
    </div>
</div>

</body>
</html>