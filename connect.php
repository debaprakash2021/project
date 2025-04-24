<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "login";
$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error) {
    die("Failed to connect to database: " . $conn->connect_error); // Use die() instead of echo
}
?>