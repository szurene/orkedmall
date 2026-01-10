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
$birthDate = $_POST['birthDate'];

$sql = "
UPDATE member SET
    firstName = ?,
    lastName  = ?,
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
$stmt->bind_param(
    "sssssssssi",
    $firstName,
    $lastName,
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
