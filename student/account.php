  <?php
ob_start();
session_start();

// Check if user is logged in and is a student
if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'student') {
    header("Location: ../login.php");
    exit();
}

require_once('connect.php'); // ensure $conn is defined

$success_msg = $error_msg = "";

// Handle update submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['done'])) {
    try {
        // Validate required fields
        foreach (['name', 'dept', 'batch', 'semester', 'email', 'id'] as $field) {
            if (empty($_POST[$field])) {
                throw new Exception(ucfirst($field) . " cannot be empty");
            }
        }

        // Sanitize and assign
        $name     = trim($_POST['name']);
        $dept     = trim($_POST['dept']);
        $batch    = trim($_POST['batch']);
        $semester = trim($_POST['semester']);
        $email    = trim($_POST['email']);
        $sid      = trim($_POST['id']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }

        // Update query using prepared statement
        $stmt = $conn->prepare("UPDATE students SET st_name=?, st_dept=?, st_batch=?, st_sem=?, st_email=? WHERE st_id=?");
        $stmt->bind_param("ssssss", $name, $dept, $batch, $semester, $email, $sid);

        if ($stmt->execute()) {
            $success_msg = "✅ Updated successfully.";
        } else {
            throw new Exception("❌ Update failed: " . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        $error_msg = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Online Attendance Management System 1.0</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
            <h3>Update Account</h3><br>

            <?php if ($success_msg): ?>
                <p class="alert alert-success"><?php echo $success_msg; ?></p>
            <?php elseif ($error_msg): ?>
                <p class="alert alert-danger"><?php echo $error_msg; ?></p>
            <?php endif; ?>

            <!-- Search Form -->
            <form method="POST" class="form-horizontal col-md-6 col-md-offset-3">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Registration No.</label>
                    <div class="col-sm-7">
                        <input type="text" name="sr_id" class="form-control" placeholder="Enter your reg. no. to continue" required>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Go!" name="sr_btn">
            </form>

            <?php
            if (isset($_POST['sr_btn'])):
                $sr_id = trim($_POST['sr_id']);

                $stmt = $conn->prepare("SELECT * FROM students WHERE st_id = ?");
                $stmt->bind_param("s", $sr_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0):
                    $data = $result->fetch_assoc();
            ?>

            <!-- Update Form -->
            <form method="POST" class="form-horizontal col-md-6 col-md-offset-3">
                <table class="table table-striped">
                    <tr><td>Registration No.:</td><td><?php echo htmlspecialchars($data['st_id']); ?></td></tr>
                    <tr><td>Name:</td><td><input type="text" name="name" value="<?php echo htmlspecialchars($data['st_name']); ?>" required></td></tr>
                    <tr><td>Department:</td><td><input type="text" name="dept" value="<?php echo htmlspecialchars($data['st_dept']); ?>" required></td></tr>
                    <tr><td>Batch:</td><td><input type="text" name="batch" value="<?php echo htmlspecialchars($data['st_batch']); ?>" required></td></tr>
                    <tr><td>Semester:</td><td><input type="text" name="semester" value="<?php echo htmlspecialchars($data['st_sem']); ?>" required></td></tr>
                    <tr><td>Email:</td><td><input type="email" name="email" value="<?php echo htmlspecialchars($data['st_email']); ?>" required></td></tr>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['st_id']); ?>">
                    <tr>
                        <td></td>
                        <td><input type="submit" name="done" value="Update" class="btn btn-success"></td>
                    </tr>
                </table>
            </form>

            <?php
                else:
                    echo "<p class='alert alert-warning'>❌ No student found with that ID.</p>";
                endif;
                $stmt->close();
            endif;
            ?>
        </div>
    </div>
</center>

</body>
</html>