<?php
session_start();
if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require '../connect.php';
require '../email_config.php';

$success_msg = "";
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['pass']);
        $fname = trim($_POST['fname']);
        $phone = trim($_POST['phone']);
        $type = $_POST['type'];
        
        // Validate input
        if (empty($username) || empty($email) || empty($password) || empty($fname) || empty($phone) || empty($type)) {
            $error_msg = "❌ All fields are required.";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            
            // Use PDO for insertion
            $stmt = $pdo->prepare("INSERT INTO admininfo (username, email, password, fname, phone, type) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$username, $email, $hashed_password, $fname, $phone, $type])) {
                $success_msg = "✅ User created successfully!";
                
                // Send welcome email
                sendWelcomeEmail($email, $fname, $username, $type);
            } else {
                $error_msg = "❌ Error during user creation. Please try again.";
            }
        }
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            $error_msg = "❌ Username already exists. Please choose a different username.";
        } else {
            $error_msg = "❌ Database error: " . $e->getMessage();
        }
    }
}

// Email functions are now in email_config.php
?>

<!DOCTYPE html>
<html lang="en">

<!-- head started -->
<head>
<title>Online Attendance Management System 1.0</title>
<meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
   
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
   
  <link rel="stylesheet" href="styles.css" >
   
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<!-- head ended -->

<!-- body started -->
<body>

    <!-- Menus started-->
    <header>

      <h1>Online Attendance Management System 1.0</h1>
      <div class="navbar">
      <a href="signup.php">Create Users</a>
      <a href="index.php">Add Data</a>
      <a href="../logout.php">Logout</a>

    </div>

    </header>
    <!-- Menus ended -->

<center>
<h1>Create User</h1>
<p>    <?php
    if(isset($success_msg)) echo $success_msg;
    if(isset($error_msg)) echo $error_msg;
     ?>
       
     </p>
     <br>
<div class="content">

  <div class="row">
   
    <form method="POST" action="signup.php" class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-sm-3">Username:</label>
            <div class="col-sm-9">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3">Email:</label>
            <div class="col-sm-9">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3">Password:</label>
            <div class="col-sm-9">
                <input type="password" name="pass" class="form-control" placeholder="Password" required>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3">Full Name:</label>
            <div class="col-sm-9">
                <input type="text" name="fname" class="form-control" placeholder="Full Name" required>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3">Phone:</label>
            <div class="col-sm-9">
                <input type="text" name="phone" class="form-control" placeholder="Phone" required>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3">User Type:</label>
            <div class="col-sm-9">
                <select name="type" class="form-control" required>
                    <option value="">-- Select User Type --</option>
                    <option value="admin">Admin</option>
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <input type="submit" value="Create User" class="btn btn-primary">
            </div>
        </div>
    </form>
  </div>
    <br>
    <p><strong>Already have an account? <a href="../index.php">Login</a> here.</strong></p>

</div>

</center>

</body>
<!-- Body ended  -->

</html>
