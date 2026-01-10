<?php
session_start();
include 'db.php';

if (!isset($_SESSION['memberID'])) {
    header("Location: index.php");
    exit();
}

$memberID  = $_SESSION['memberID'];

// 1. Get the single fullName from the POST data
$fullName  = $_POST['fullName']; 
$email     = $_POST['email'];
$phoneNum  = $_POST['phoneNum'];
$street    = $_POST['street'];
$city      = $_POST['city'];
$postcode  = $_POST['postcode'];
$state     = $_POST['state'];
$birthDate = $_POST['birthDate'];

// 2. Updated SQL to use the fullName column
$sql = "
UPDATE member SET
    fullName  = ?,
    email     = ?,
    phoneNum  = ?,
    street    = ?,
    city      = ?,
    postcode  = ?,
    state     = ?,
    birthDate = ?
WHERE memberID = ?
";

$stmt = $conn->prepare($sql);

// 3. Updated bind_param: removed one "s" and one name variable
// New string: "ssssssssi" (8 strings, 1 integer)
$stmt->bind_param(
    "ssssssssi",
    $fullName,
    $email,
    $phoneNum,
    $street,
    $city,
    $postcode,
    $state,
    $birthDate,
    $memberID
);

$stmt->execute();

header("Location: memberProfile.php");
exit;