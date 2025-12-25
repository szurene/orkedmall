<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = $_POST['firstName'];
    $lastname  = $_POST['lastName'];
    $email     = $_POST['email'];
    $phoneNum  = $_POST['phoneNum'];
    $street    = $_POST['street'];
    $city      = $_POST['city'];
    $postcode  = $_POST['postcode'];
    $state     = $_POST['state'];

    $password  = $_POST['password'];
    $confirm   = $_POST['confirm'];

    // 🔐 SERVER-SIDE PASSWORD MATCH CHECK
    if ($password !== $confirm) {
        echo "<script>
                alert('Password and Confirm Password do not match!');
                window.history.back();
              </script>";
        exit;
    }

    // Hash only AFTER confirmation
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO member 
            (firstName, lastName, email, phoneNum, street, city, postcode, state, password)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssss",
        $firstname,
        $lastname,
        $email,
        $phoneNum,
        $street,
        $city,
        $postcode,
        $state,
        $hashedPassword
    );

    if ($stmt->execute()) {
        echo "<script>
                alert('Registration successful!');
                window.location.href='index.html';
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
