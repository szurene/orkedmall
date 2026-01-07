<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "orkeddata");

if (!$conn) {
    die("Database connection failed");
}

// Get input
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare SQL
$sql = "SELECT * FROM admin WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if ($admin = mysqli_fetch_assoc($result)) {

    // Verify hashed password
    if (password_verify($password, $admin['adPassword'])) {

        // Save admin session
        $_SESSION['adminID'] = $admin['adminID'];
        $_SESSION['adminUsername'] = $admin['username'];

        // Redirect
        header("Location: adminDashboard.php");
        exit;
    }
}

// If login fails
echo "<script>
        alert('Invalid admin username or password');
        window.location.href = 'admin_login.php';
      </script>";
?>
