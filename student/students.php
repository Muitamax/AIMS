<?php

ob_start();
session_start();

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'student') {
    header("Location: ../login.php");
    exit();
}
?>
<?php include('connect.php');?>

<!DOCTYPE html>
<html lang="en">
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
<body>

<header>

  <h1>Online Attendance Management System 1.0</h1>
  <div class="navbar">
  <a href="index.php">Home</a>
  <a href="students.php">Students</a>
  <a href="report.php">My Report</a>
  <a href="account.php">My Account</a>
  <a href="../logout.php">Logout</a>

</div>

</header>

<center>

<div class="row">

  <div class="content">
    <h3>Student List</h3>
    <br>

   <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Batch</label>
            <div class="col-sm-7">
                <input type="text" name="sr_batch"  class="form-control" id="input1" placeholder="Only 2020" />
                
            </div>

      </div>
      <input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Go!" name="sr_btn" />
      
   </form>

   <div class="content"></div>
    <table class="table table-striped">
      
      <thead>
      <tr>
        <th scope="col">Registration No.</th>
        <th scope="col">Name</th>
        <th scope="col">Department</th>
        <th scope="col">Batch</th>
        <th scope="col">Semester</th>
        <th scope="col">Email</th>
      </tr>
      </thead>
   <?php
require_once("connect.php"); // Ensure $conn is defined

if (isset($_POST['sr_btn'])) {
    $srbatch = $_POST['sr_batch'] ?? 2020;
    
    // Use prepared statement for safety
    $stmt = $conn->prepare("SELECT * FROM students WHERE st_batch = ? ORDER BY st_id ASC");
    $stmt->bind_param("s", $srbatch);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($data = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($data['st_id']) . "</td>";
            echo "<td>" . htmlspecialchars($data['st_name']) . "</td>";
            echo "<td>" . htmlspecialchars($data['st_dept']) . "</td>";
            echo "<td>" . htmlspecialchars($data['st_batch']) . "</td>";
            echo "<td>" . htmlspecialchars($data['st_sem']) . "</td>";
            echo "<td>" . htmlspecialchars($data['st_email']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No students found for batch $srbatch</td></tr>";
    }

    $stmt->close();
} else {
    echo "<tr><td colspan='6'>Please enter a batch number and click 'Go!' to view students</td></tr>";
}
?>
    </table>

  </div>

</div>

</center>

</body>
</html>
