<?php
$host = "localhost";       //database host
$user = "root";            //database username
$pass = "";                //database password
$dbName = "orked_mall";    //database name

// Create connection
$conn = new mysqli($host, $user, $pass, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>