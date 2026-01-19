<?php
header('Content-Type: application/json');
include 'db.php';

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'Missing ID']);
    exit;
}

$id = intval($_GET['id']);

$stmt = $conn->prepare(
    "SELECT fullName, phoneNum, street, city, postcode, state, birthDate
     FROM member
     WHERE memberID = ?"
);

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'Member not found']);
}

$stmt->close();
$conn->close();
