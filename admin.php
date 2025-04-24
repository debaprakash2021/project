<?php
session_start(); // ADD THIS LINE
include "con2.php";
if (isset($_POST['logIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM admin WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // DEBUG: Check what's being compared
        echo "Stored hash: " . $row['Password'] . "<br>";
        echo "Input password: " . $password . "<br>";
        
        // Option 1: If using SHA2() in database
        $inputHash = hash('sha256', $password);
        if ($inputHash === $row['Password']) {
            $_SESSION['email'] = $row['email'];
            header("Location: adminHome.php");
            exit();
        }
        else {
            echo "<script>alert('Wrong Password'); window.location.href='adminLogin.html';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Email not found'); window.location.href='adminLogin.html';</script>";
        exit();
    }
}
// $insert_query="INSERT INTO `admin`(`fullName`, `email`, `phoneNo`, `Password`) 
// VALUES 
// ('Dhirendra Hudda', 'dhirendrahudda@gmail.com', '9799279475', SHA2('password123', 256)),
// ('Raman Kumar', 'ramanjaiswal790@gmail.com', '9608034977', SHA2('password456', 256)),
// ('Tathagata Ghosh', 'tathagataghosh1609@gmail.com', '8637307756', SHA2('password789', 256)),
// ('Mr. Jena', 'debaprakashjena2021@gmail.com', '8984766567', SHA2('password369', 256))";
// if ($conn->query($insert_query) === TRUE) {
//     echo "New record created successfully";
// } else {
//     echo "Error: " . $insert_query . "<br>" . $conn->error;
// }
?>