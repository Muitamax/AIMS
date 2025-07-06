# Email Configuration Fix for AIMS

## Problem
The welcome email fails to send during user registration, even though the account is created successfully.

## Root Cause
The Apache web server cannot execute `/usr/sbin/sendmail` due to PATH or permission issues.

## Solutions

### Solution 1: Install and Configure Sendmail (Recommended)

1. **Install sendmail package:**
   ```bash
   sudo apt-get update
   sudo apt-get install sendmail sendmail-cf
   ```

2. **Configure sendmail:**
   ```bash
   sudo sendmailconfig
   ```
   (Answer 'Y' to all questions)

3. **Start sendmail service:**
   ```bash
   sudo systemctl start sendmail
   sudo systemctl enable sendmail
   ```

4. **Restart Apache:**
   ```bash
   sudo /opt/lampp/lampp restart
   ```

### Solution 2: Use PHPMailer (Alternative)

If sendmail doesn't work, you can use PHPMailer for better email handling:

1. **Download PHPMailer:**
   ```bash
   cd /opt/lampp/htdocs/AIMS
   wget https://github.com/PHPMailer/PHPMailer/archive/v6.8.0.zip
   unzip v6.8.0.zip
   mv PHPMailer-6.8.0 PHPMailer
   ```

2. **Update email_config.php to use PHPMailer**

### Solution 3: Configure Gmail SMTP

For production use, configure Gmail SMTP in your email system.

## Testing Commands

Test if sendmail is working:
```bash
echo "Test email body" | sendmail -v your@email.com
```

Test from command line:
```bash
cd /opt/lampp/htdocs/AIMS
/opt/lampp/bin/php debug_mail.php
```

## Quick Fix (Temporary)

If you want to disable email notifications temporarily:
- Comment out the email sending code in signup.php
- Or modify the success message to not mention email issues

## Files to Check

1. `/opt/lampp/htdocs/AIMS/email_config.php` - Email configuration
2. `/opt/lampp/htdocs/AIMS/signup.php` - User registration with email
3. `/opt/lampp/logs/error_log` - Apache error log
4. `/opt/lampp/bin/php -i | grep mail` - PHP mail configuration