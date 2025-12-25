<?php
$host = "localhost";       // your database host
$user = "root";            // your database username
$pass = "";                // your database password
$dbName = "orkeddata";     // your updated database name

// Create connection
$conn = new mysqli($host, $user, $pass, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>