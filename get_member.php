<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Fetch member data
    $sql = "SELECT firstName, lastName, phoneNum FROM member WHERE memberID = $id";
    $result = $conn->query($sql);
    
    if ($result && $row = $result->fetch_assoc()) {
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Member not found']);
    }
}
$conn->close();
?>