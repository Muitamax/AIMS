# AIMS
📘 Attendance Information Management System (AIMS)

AIMS is a web-based application designed to streamline attendance tracking and reporting in academic institutions. It supports multiple user roles—Admin, Teacher, and Student—each with tailored access and functionality. The system is built using PHP, MySQL, HTML5, CSS3, and integrates email notifications via SMTP.
🚀 Features

    🔐 Secure multi-role login system (Admin, Teacher, Student)

    📝 Attendance marking and tracking by teachers

    📊 Attendance history and reports for students and admins

    📧 Email notifications for attendance events

    🗂️ Role-specific dashboards and access control

    🧩 Modular PHP structure for maintainability

🧱 System Architecture
🖥️ Frontend

    HTML5, CSS3 for layout and styling

    JavaScript for interactivity and form validation

⚙️ Backend

    PHP (procedural/modular)

    MySQL for data storage

    Postfix + SMTP for email delivery

📁 Directory Structure
Folder/File	Description
admin/	Admin dashboard and management tools
teacher/	Teacher dashboard and attendance tools
student/	Student dashboard and attendance history
includes/	Shared scripts (e.g., DB connection, session handling)
config/	Configuration files (e.g., database, SMTP settings)
attendance/	Attendance submission and reporting logic
email/	Email templates and sending scripts
css/, js/	Frontend assets
index.php	Login page
dashboard.php	Role-based dashboard redirection
README.md	Project documentation
👥 User Roles & Permissions
Role	Capabilities
Admin	Manage users, view all attendance records, configure system
Teacher	Mark attendance, view class records
Student	View personal attendance history
🛠️ Installation & Setup
Prerequisites

    Ubuntu 20.04+ (or compatible Linux distro)

    Apache/Nginx with PHP 7.4+

    MySQL/MariaDB

    Postfix (or any SMTP server)

Steps

    Clone the repository:
    bash
    git clone https://github.com/Muitamax/AIMS.git
cd AIMS

Import the database:

    Create a MySQL database (e.g., aims_db)

    Import the SQL schema from db/aims.sql

Configure database and SMTP settings:

    Edit config/db.php with your DB credentials

    Edit config/mail.php with your SMTP settings

Set appropriate permissions:
bash
sudo chown -R www-data:www-data /var/www/html/AIMS

Access the system via your browser:
http://localhost/AIMS

📧 Email Notification System

The system uses PHP's mail() function or SMTP (via Postfix) to send:

    Attendance confirmations

    Absence alerts

    Password reset or registration emails

Ensure your SMTP server is properly configured and SPF/DKIM/DMARC records are set for deliverability.
🔐 Security Considerations

    Passwords should be hashed using password_hash() (if not already)

    Input validation and sanitization to prevent SQL injection

    Session management to prevent unauthorized access

    CSRF protection for form submissions (recommended)

📈 Future Enhancements

    Add biometric or QR code-based attendance

    Integrate analytics dashboards (e.g., Chart.js)

    Export attendance reports to PDF/Excel

    Implement RESTful API for mobile integration

    Add role-based access control using middleware

🤝 Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you’d like to change.


📄 License
This project is licensed under the MIT License.
