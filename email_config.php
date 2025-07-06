<?php
// Email configuration for AIMS
// This file contains email sending functions

// Email configuration
$email_config = [
    'from_email' => 'muitamaxwell@gmail.com',        // 👈 CHANGE THIS: Your sender email
    'from_name' => 'AIMS - Online Attendance Management System',
    'reply_to' => 'muitamaxwell@gmail.com'          // 👈 CHANGE THIS: Your reply-to email
];

/**
 * Send email function
 * @param string $to - Recipient email
 * @param string $subject - Email subject
 * @param string $message - Email message
 * @param bool $is_html - Whether the message is HTML
 * @return bool - Success status
 */
function sendEmail($to, $subject, $message, $is_html = true) {
    global $email_config;
    
    // Log email attempt
    error_log("AIMS: Attempting to send email to: " . $to . " Subject: " . $subject);
    
    // Check if mail function exists
    if (!function_exists('mail')) {
        error_log("AIMS: PHP mail() function is not available");
        return false;
    }
    
    // Set headers
    $headers = "From: " . $email_config['from_name'] . " <" . $email_config['from_email'] . ">\r\n";
    $headers .= "Reply-To: " . $email_config['reply_to'] . "\r\n";
    
    if ($is_html) {
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    } else {
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    }
    
    // Send email
    $result = mail($to, $subject, $message, $headers);
    
    if ($result) {
        error_log("AIMS: Email sent successfully to: " . $to);
        return true;
    } else {
        error_log("AIMS: Email sending failed to: " . $to);
        return false;
    }
}

/**
 * Send welcome email for new user registration
 */
function sendWelcomeEmail($to, $name, $username, $user_type = 'user') {
    $subject = "Welcome to AIMS - Account Created Successfully";
    
    $message = "
    <html>
    <head>
        <title>$subject</title>
        <style>
            body { font-family: Arial, sans-serif; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #007bff; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; background-color: #f8f9fa; }
            .footer { padding: 20px; text-align: center; color: #666; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>Welcome to AIMS</h2>
            </div>
            <div class='content'>
                <p>Dear $name,</p>
                <p>Your account has been created successfully in the Online Attendance Management System!</p>
                <p><strong>Your login details:</strong></p>
                <ul>
                    <li>Username: $username</li>
                    <li>Email: $to</li>
                    <li>Account Type: " . ucfirst($user_type) . "</li>
                </ul>
                <p>You can now login to the system using your credentials at: <a href='http://localhost/AIMS/login.php'>AIMS Login</a></p>
                <p>Thank you for joining us!</p>
            </div>
            <div class='footer'>
                <p>Best regards,<br>AIMS Team</p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    // Try to send email, but don't break the system if it fails
    $result = sendEmail($to, $subject, $message);
    
    // Log the result
    if ($result) {
        error_log("AIMS: Welcome email sent successfully to: " . $to);
    } else {
        error_log("AIMS: Welcome email failed to send to: " . $to);
    }
    
    return $result;
}

/**
 * Send login notification email
 */
function sendLoginNotification($to, $name) {
    $subject = "Login Notification - AIMS";
    $login_time = date('Y-m-d H:i:s');
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    
    $message = "
    <html>
    <head>
        <title>$subject</title>
        <style>
            body { font-family: Arial, sans-serif; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #28a745; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; background-color: #f8f9fa; }
            .footer { padding: 20px; text-align: center; color: #666; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>Login Notification</h2>
            </div>
            <div class='content'>
                <p>Hello $name,</p>
                <p>You have successfully logged into the AIMS system.</p>
                <p><strong>Login Details:</strong></p>
                <ul>
                    <li>Time: $login_time</li>
                    <li>IP Address: $ip_address</li>
                </ul>
                <p>If this wasn't you, please contact the administrator immediately.</p>
                <p>Thank you for using our system!</p>
            </div>
            <div class='footer'>
                <p>Best regards,<br>AIMS Team</p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    return sendEmail($to, $subject, $message);
}

/**
 * Send account creation notification for students/teachers
 */
function sendAccountCreationNotification($to, $name, $id, $type) {
    $subject = "Account Created - AIMS";
    
    $message = "
    <html>
    <head>
        <title>$subject</title>
        <style>
            body { font-family: Arial, sans-serif; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #17a2b8; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; background-color: #f8f9fa; }
            .footer { padding: 20px; text-align: center; color: #666; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>Account Created Successfully</h2>
            </div>
            <div class='content'>
                <p>Dear $name,</p>
                <p>Your " . ucfirst($type) . " account has been created successfully in the AIMS system!</p>
                <p><strong>Your Details:</strong></p>
                <ul>
                    <li>" . ucfirst($type) . " ID: $id</li>
                    <li>Email: $to</li>
                    <li>Default Password: $id (Please change this after first login)</li>
                </ul>
                <p>You can login to the system at: <a href='http://localhost/AIMS/login.php'>AIMS Login</a></p>
                <p>Thank you for joining us!</p>
            </div>
            <div class='footer'>
                <p>Best regards,<br>AIMS Team</p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    return sendEmail($to, $subject, $message);
}
?>