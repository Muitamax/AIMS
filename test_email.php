<?php
// Test email functionality
require_once('email_config.php');

echo "<h2>Email System Test</h2>";

// Test 1: Basic email function
echo "<h3>Test 1: Basic Email Function</h3>";
if (function_exists('sendEmail')) {
    echo "✅ sendEmail function exists<br>";
} else {
    echo "❌ sendEmail function missing<br>";
}

// Test 2: Welcome email function
echo "<h3>Test 2: Welcome Email Function</h3>";
if (function_exists('sendWelcomeEmail')) {
    echo "✅ sendWelcomeEmail function exists<br>";
} else {
    echo "❌ sendWelcomeEmail function missing<br>";
}

// Test 3: Login notification function
echo "<h3>Test 3: Login Notification Function</h3>";
if (function_exists('sendLoginNotification')) {
    echo "✅ sendLoginNotification function exists<br>";
} else {
    echo "❌ sendLoginNotification function missing<br>";
}

// Test 4: Check if mail function is available
echo "<h3>Test 4: PHP Mail Function</h3>";
if (function_exists('mail')) {
    echo "✅ PHP mail() function is available<br>";
} else {
    echo "❌ PHP mail() function is not available<br>";
}

// Test 5: Check email configuration
echo "<h3>Test 5: Email Configuration</h3>";
if (isset($email_config)) {
    echo "✅ Email configuration loaded<br>";
    echo "From Email: " . $email_config['from_email'] . "<br>";
    echo "From Name: " . $email_config['from_name'] . "<br>";
} else {
    echo "❌ Email configuration not loaded<br>";
}

// Test 6: Simulate email sending (without actually sending)
echo "<h3>Test 6: Email Simulation</h3>";
$test_email = "test@example.com";
$test_name = "Test User";
$test_username = "testuser";

echo "Would send welcome email to: $test_email<br>";
echo "Subject: Welcome to AIMS - Account Created Successfully<br>";
echo "Message contains: login details, username, etc.<br>";

// Test 7: Check server configuration
echo "<h3>Test 7: Server Configuration</h3>";
echo "Server: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "<br>";
echo "PHP Version: " . phpversion() . "<br>";

// Test 8: Simple email test (ENABLED)
echo "<h3>Test 8: Simple Email Test</h3>";
echo "📧 Email test is now ENABLED<br>";

// Test email sending
$test_result = sendEmail("test@example.com", "AIMS Test Email", "This is a test message from AIMS system to verify email functionality.");
if ($test_result) {
    echo "✅ Email sent successfully to test@example.com<br>";
} else {
    echo "❌ Email sending failed<br>";
}

// Test welcome email
echo "<br><strong>Testing Welcome Email:</strong><br>";
$welcome_result = sendWelcomeEmail("welcome@example.com", "Test User", "testuser", "student");
if ($welcome_result) {
    echo "✅ Welcome email sent successfully<br>";
} else {
    echo "❌ Welcome email sending failed<br>";
}

// Test login notification
echo "<br><strong>Testing Login Notification:</strong><br>";
$login_result = sendLoginNotification("login@example.com", "Test User");
if ($login_result) {
    echo "✅ Login notification sent successfully<br>";
} else {
    echo "❌ Login notification sending failed<br>";
}

echo "<br><a href='index.php'>Back to Main Page</a>";
?>