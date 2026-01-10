<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: memberRegister.php");
    exit();
}

/* ----------------------
   MEMBER DATA
---------------------- */
$firstname = $_POST['firstName'];
$lastname  = $_POST['lastName'];
$email     = $_POST['email'];
$phoneNum  = $_POST['phoneNum'];
$street    = $_POST['street'];
$city      = $_POST['city'];
$postcode  = $_POST['postcode'];
$state     = $_POST['state'];
$birthDate = $_POST['birthDate'];

$password  = $_POST['password'];
$confirm   = $_POST['confirm'];

/* ----------------------
   AGE VALIDATION - MOVED TO TOP
---------------------- */
if (empty($birthDate)) {
    echo "<script>alert('Birth date is required!'); window.history.back();</script>";
    exit;
}

// Calculate age
$birthDateObj = new DateTime($birthDate);
$today = new DateTime();
$age = $today->diff($birthDateObj)->y;

if ($age < 18) {
    echo "<script>alert('You must be at least 18 years old to register.'); window.history.back();</script>";
    exit;
}

/* ----------------------
   MEMBERSHIP TYPE
---------------------- */
if (!isset($_POST['membershipType'])) {
    header("Location: memberRegister.php");
    exit();
}
$mTypeID = intval($_POST['membershipType']);

/* ----------------------
   PASSWORD CHECK
---------------------- */
if ($password !== $confirm) {
    header("Location: memberRegister.php");
    exit();
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

/* ----------------------
   CHECK IF EMAIL ALREADY EXISTS
---------------------- */
$sqlCheck = "SELECT memberID FROM member WHERE email = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("s", $email);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    echo "<script>
            alert('Email already registered. Please use another email.');
            window.history.back();
          </script>";
    exit();
}

/* ----------------------
   INSERT MEMBER
---------------------- */
$sqlMember = "INSERT INTO member
(firstName, lastName, email, phoneNum, street, city, postcode, state, birthDate, password)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmtMember = $conn->prepare($sqlMember);
$stmtMember->bind_param(
    "ssssssssss",
    $firstname, $lastname, $email, $phoneNum,
    $street, $city, $postcode, $state,
    $birthDate, $hashedPassword
);

if (!$stmtMember->execute()) {
    die("Member insert error: " . $stmtMember->error);
}

$memberID = $conn->insert_id;

/* ----------------------
   GET MEMBERSHIP INFO
---------------------- */
$sqlType = "SELECT duration, price FROM membership_type WHERE mTypeID = ?";
$stmtType = $conn->prepare($sqlType);
$stmtType->bind_param("i", $mTypeID);
$stmtType->execute();
$resultType = $stmtType->get_result();

if ($resultType->num_rows === 0) {
    die("Invalid membership type.");
}

$typeRow = $resultType->fetch_assoc();
$durationMonths = intval($typeRow['duration']);
$amount         = floatval($typeRow['price']);

/* ----------------------
   CALCULATE DATES
---------------------- */
$startDate = date("Y-m-d");
$endDate   = date("Y-m-d", strtotime("+$durationMonths months"));

/* ----------------------
   INSERT MEMBERSHIP
---------------------- */
$sqlMembership = "INSERT INTO membership
(startDate, endDate, memberID, mTypeID)
VALUES (?, ?, ?, ?)";

$stmtMembership = $conn->prepare($sqlMembership);
$stmtMembership->bind_param(
    "ssii",
    $startDate, $endDate, $memberID, $mTypeID
);

if (!$stmtMembership->execute()) {
    die("Membership insert error: " . $stmtMembership->error);
}

$membershipID = $conn->insert_id;

/* ----------------------
   STORE FOR PAYMENT STEP
---------------------- */
$_SESSION['memberID']     = $memberID;
$_SESSION['membershipID'] = $membershipID;
$_SESSION['amount']       = $amount;

/* ----------------------
   SEND CONFIRMATION EMAIL
---------------------- */
require_once 'mailer/config.php'; // Adjust path as needed

if (sendRegistrationEmail($email, $firstname, $lastname, $memberID, $startDate, $endDate, $durationMonths)) {
    $_SESSION['email_sent'] = true;
} else {
    $_SESSION['email_sent'] = false;
    // Log error but don't interrupt registration
    error_log("Failed to send registration email to: $email");
}

/* ----------------------
   REDIRECT TO PAYMENT
---------------------- */
header("Location: payment.php");
exit();