<?php
session_start();
include 'db.php';

$email    = $_POST['email'];
$password = $_POST['password'];

/* GET MEMBER + MEMBERSHIP TYPE */
$sql = "
SELECT m.memberID, m.password, mt.mTypeName
FROM member m
JOIN membership ms ON m.memberID = ms.memberID
JOIN membership_type mt ON ms.mTypeID = mt.mTypeID
WHERE m.email = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('Invalid login'); window.location.href='index.php';</script>";
    exit;
}

$row = $result->fetch_assoc();

if (!password_verify($password, $row['password'])) {
    echo "<script>alert('Invalid login'); window.location.href='index.php';</script>";
    exit;
}

/* STORE SESSION */
$_SESSION['memberID'] = $row['memberID'];
$_SESSION['membershipType'] = strtolower($row['mTypeName']); // gold / platinum

header("Location: memberDashboard.php");
exit;
