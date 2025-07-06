# 📧 Email Testing Guide - AIMS System

## ✅ Email Testing Now ENABLED!

I've successfully enabled email testing in the AIMS system. Here's what you can now do:

## 🔧 Email Testing Tools Created

### 1. **Technical Email Test** - `test_email.php`
- ✅ **ENABLED** - No longer disabled
- Tests all email functions automatically
- Shows detailed technical information
- Tests basic email, welcome email, and login notifications
- **URL**: `http://localhost/AIMS/test_email.php`

### 2. **Email Test Form** - `email_test_form.php` (NEW)
- 📧 Interactive form to send test emails
- Enter your real email address to receive test emails
- Choose different email types (basic, welcome, login)
- User-friendly interface with results display
- **URL**: `http://localhost/AIMS/email_test_form.php`

### 3. **Email Debug Tool** - `email_debug.php` (NEW)
- 🐛 Comprehensive email system debugging
- Shows PHP configuration, mail function status
- Displays server information and setup instructions
- Helps troubleshoot email issues
- **URL**: `http://localhost/AIMS/email_debug.php`

## 🎯 How to Test Emails

### Quick Test (Automatic):
1. Visit: `http://localhost/AIMS/test_email.php`
2. The page will automatically attempt to send 3 test emails
3. Check the results on the page

### Interactive Test (Manual):
1. Visit: `http://localhost/AIMS/email_test_form.php`
2. Enter your real email address
3. Choose email type (basic, welcome, or login)
4. Click "Send Test Email"
5. Check your inbox for the email

### Debug Email Issues:
1. Visit: `http://localhost/AIMS/email_debug.php`
2. Review all the configuration information
3. Follow the setup instructions if needed

## 📧 Email Types You Can Test

### 1. **Basic Test Email**
- Simple test message with timestamp
- Verifies basic email sending functionality

### 2. **Welcome Email**
- HTML formatted welcome message
- Includes login credentials and system info
- Sent when new accounts are created

### 3. **Login Notification**
- Notifies about successful login
- Includes login time and IP address
- Sent every time a user logs in

## 🔗 Easy Access Links

All email testing tools are now accessible from the main page:

**From Main Page** (`http://localhost/AIMS/index.php`):
- 🔧 **Technical Test** - Shows all email function tests
- 📧 **Send Test Email** - Interactive form for testing
- 🐛 **Debug Info** - Configuration and troubleshooting

## ⚙️ Email Setup for Your Server

### If Emails Are Not Working:

1. **Check PHP Configuration**:
   ```bash
   php -m | grep mail
   ```

2. **Install Sendmail (Linux)**:
   ```bash
   sudo apt-get install sendmail
   sudo service sendmail start
   ```

3. **Configure PHP (php.ini)**:
   ```ini
   sendmail_path = /usr/sbin/sendmail -t -i
   ```

4. **For XAMPP Users**:
   - Enable sendmail in XAMPP control panel
   - Configure sendmail.ini in XAMPP folder

5. **Test from Command Line**:
   ```bash
   echo "Test message" | mail -s "Test Subject" your@email.com
   ```

## 📋 Test Results Explanation

### ✅ Success Messages:
- **Email sent successfully** - Email was sent without errors
- **Function exists** - Required email functions are available
- **Configuration loaded** - Email settings are properly configured

### ❌ Error Messages:
- **Email sending failed** - Check server mail configuration
- **Function not available** - Email functions not loaded properly
- **mail() function not available** - PHP mail function not configured

### ⚠️ Warning Messages:
- **SMTP settings not configured** - May need SMTP setup for production
- **Sendmail path not configured** - May need sendmail installation

## 🎉 Test Your Email System Now!

1. **Visit the main page**: `http://localhost/AIMS/index.php`
2. **Look for "Email System Testing" section**
3. **Click any of the email testing tools**
4. **Follow the instructions on each page**

## 🔄 Testing Workflow

1. **Start with Debug Info** - Check if email system is properly configured
2. **Run Technical Test** - See if functions work automatically
3. **Use Test Form** - Send emails to your real email address
4. **Test Real Signup/Login** - Create account and login to test real workflow

The email testing system is now fully operational and ready for use!