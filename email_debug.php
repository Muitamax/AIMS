<?php
// Email debugging and configuration checker
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Email Debug - AIMS</title>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .debug-box { background: #f8f9fa; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .success { color: #155724; background: #d4edda; border: 1px solid #c3e6cb; }
        .error { color: #721c24; background: #f8d7da; border: 1px solid #f5c6cb; }
        .warning { color: #856404; background: #fff3cd; border: 1px solid #ffeeba; }
        .info { color: #0c5460; background: #d1ecf1; border: 1px solid #bee5eb; }
    </style>
</head>
<body>

<h2>📧 Email System Debug Information</h2>

<div class="debug-box info">
    <h3>💡 Email Configuration Status</h3>
    
    <?php
    // Check if email_config.php exists
    if (file_exists('email_config.php')) {
        echo "<p>✅ email_config.php file exists</p>";
        require_once('email_config.php');
        
        // Check if functions exist
        if (function_exists('sendEmail')) {
            echo "<p>✅ sendEmail function is available</p>";
        } else {
            echo "<p>❌ sendEmail function is NOT available</p>";
        }
        
        if (function_exists('sendWelcomeEmail')) {
            echo "<p>✅ sendWelcomeEmail function is available</p>";
        } else {
            echo "<p>❌ sendWelcomeEmail function is NOT available</p>";
        }
        
        if (function_exists('sendLoginNotification')) {
            echo "<p>✅ sendLoginNotification function is available</p>";
        } else {
            echo "<p>❌ sendLoginNotification function is NOT available</p>";
        }
        
        // Check email configuration
        if (isset($email_config)) {
            echo "<p>✅ Email configuration loaded:</p>";
            echo "<ul>";
            echo "<li>From Email: " . $email_config['from_email'] . "</li>";
            echo "<li>From Name: " . $email_config['from_name'] . "</li>";
            echo "<li>Reply To: " . $email_config['reply_to'] . "</li>";
            echo "</ul>";
        } else {
            echo "<p>❌ Email configuration not found</p>";
        }
    } else {
        echo "<p>❌ email_config.php file NOT found</p>";
    }
    ?>
</div>

<div class="debug-box info">
    <h3>🔧 PHP Mail Function Status</h3>
    
    <?php
    // Check if mail function is available
    if (function_exists('mail')) {
        echo "<p>✅ PHP mail() function is available</p>";
    } else {
        echo "<p>❌ PHP mail() function is NOT available</p>";
        echo "<p>⚠️ You need to install a mail server (like sendmail) or configure SMTP</p>";
    }
    
    // Check sendmail path
    $sendmail_path = ini_get('sendmail_path');
    if (!empty($sendmail_path)) {
        echo "<p>✅ Sendmail path configured: " . $sendmail_path . "</p>";
    } else {
        echo "<p>⚠️ Sendmail path not configured</p>";
    }
    
    // Check SMTP settings
    $smtp_host = ini_get('SMTP');
    $smtp_port = ini_get('smtp_port');
    
    if (!empty($smtp_host)) {
        echo "<p>✅ SMTP Host: " . $smtp_host . "</p>";
        echo "<p>✅ SMTP Port: " . $smtp_port . "</p>";
    } else {
        echo "<p>⚠️ SMTP settings not configured</p>";
    }
    ?>
</div>

<div class="debug-box warning">
    <h3>⚙️ Server Configuration</h3>
    
    <?php
    echo "<p><strong>Operating System:</strong> " . php_uname() . "</p>";
    echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
    echo "<p><strong>Server Software:</strong> " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "</p>";
    echo "<p><strong>Server Name:</strong> " . ($_SERVER['SERVER_NAME'] ?? 'Unknown') . "</p>";
    
    // Check if running on Windows (needs different mail setup)
    if (stripos(PHP_OS, 'WIN') === 0) {
        echo "<p>🪟 <strong>Windows detected</strong> - You may need to configure SMTP settings in php.ini</p>";
    } else {
        echo "<p>🐧 <strong>Linux/Unix detected</strong> - Sendmail should work if installed</p>";
    }
    ?>
</div>

<div class="debug-box info">
    <h3>📋 Email Setup Instructions</h3>
    
    <h4>For Local Development (XAMPP/LAMPP):</h4>
    <ol>
        <li><strong>Install sendmail:</strong>
            <pre>sudo apt-get install sendmail</pre>
        </li>
        <li><strong>Configure PHP (php.ini):</strong>
            <pre>sendmail_path = /usr/sbin/sendmail -t -i</pre>
        </li>
        <li><strong>Restart Apache:</strong>
            <pre>sudo service apache2 restart</pre>
        </li>
    </ol>
    
    <h4>For Production Server:</h4>
    <ol>
        <li>Configure SMTP settings in php.ini</li>
        <li>Use a mail service like Gmail SMTP, SendGrid, etc.</li>
        <li>Update email_config.php with proper headers</li>
    </ol>
    
    <h4>Quick Test:</h4>
    <p>Try sending a test email from command line:</p>
    <pre>echo "Test message" | mail -s "Test Subject" your@email.com</pre>
</div>

<div class="debug-box">
    <h3>🧪 Test Email System</h3>
    <p>Use these links to test the email functionality:</p>
    <ul>
        <li><a href="test_email.php">🔧 Technical Email Test</a> - Shows all email function tests</li>
        <li><a href="email_test_form.php">📧 Email Test Form</a> - Send test emails to real addresses</li>
        <li><a href="signup.php">📝 Test Signup</a> - Create account and test welcome email</li>
        <li><a href="login.php">🔐 Test Login</a> - Login and test notification email</li>
    </ul>
</div>

<div style="text-align: center; margin-top: 30px;">
    <a href="index.php" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">🏠 Back to Main Page</a>
</div>

</body>
</html>