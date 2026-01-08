<?php
session_start();
include 'db.php';

if (!isset($_SESSION['memberID'])) {
    header("Location: index.php");
    exit();
}

$memberID  = $_SESSION['memberID'];

$firstName = $_POST['firstName'];
$lastName  = $_POST['lastName'];
$email     = $_POST['email'];
$phoneNum  = $_POST['phoneNum'];
$street    = $_POST['street'];
$city      = $_POST['city'];
$postcode  = $_POST['postcode'];
$state     = $_POST['state'];

$sql = "
UPDATE member SET
    firstName = ?,
    lastName  = ?,
    email     = ?,
    phoneNum  = ?,
    street    = ?,
    city      = ?,
    postcode  = ?,
    state     = ?
WHERE memberID = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssssssi",
    $firstName,
    $lastName,
    $email,
    $phoneNum,
    $street,
    $city,
    $postcode,
    $state,
    $memberID
);

$stmt->execute();

header("Location: memberProfile.php");
exit;
