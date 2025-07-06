<?php
// Debug mail function
echo "<h2>Mail Function Debug</h2>";

// Test if mail function exists
if (function_exists('mail')) {
    echo "✅ mail() function exists<br>";
    
    // Test sending a simple email
    echo "<h3>Testing mail function...</h3>";
    
    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    // Test email
    $to = "test@example.com";
    $subject = "Test Email";
    $message = "This is a test email from AIMS system.";
    $headers = "From: muitamaxwell@gmail.com\r\n";
    
    echo "Attempting to send email to: $to<br>";
    
    $result = mail($to, $subject, $message, $headers);
    
    if ($result) {
        echo "✅ mail() function returned TRUE<br>";
    } else {
        echo "❌ mail() function returned FALSE<br>";
    }
    
    // Check last error
    $last_error = error_get_last();
    if ($last_error) {
        echo "Last error: " . $last_error['message'] . "<br>";
    }
    
} else {
    echo "❌ mail() function not available<br>";
}

// Show PHP mail configuration
echo "<h3>PHP Mail Configuration:</h3>";
echo "sendmail_path: " . ini_get('sendmail_path') . "<br>";
echo "SMTP: " . ini_get('SMTP') . "<br>";
echo "smtp_port: " . ini_get('smtp_port') . "<br>";
echo "sendmail_from: " . ini_get('sendmail_from') . "<br>";

// Test if sendmail is executable
echo "<h3>Sendmail Test:</h3>";
$sendmail_path = "/usr/sbin/sendmail";
if (is_executable($sendmail_path)) {
    echo "✅ $sendmail_path is executable<br>";
} else {
    echo "❌ $sendmail_path is NOT executable<br>";
}

// Test command line execution
echo "<h3>Command Line Test:</h3>";
exec("which sendmail", $output, $return_code);
if ($return_code === 0) {
    echo "✅ sendmail found: " . implode(' ', $output) . "<br>";
} else {
    echo "❌ sendmail not found in PATH<br>";
}

?>