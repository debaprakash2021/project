<?php
include "connect.php";

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session at the beginning of the script
session_start();

if(isset($_POST['signUp'])) {
    // Registration handling
    $name = $_POST['FullName'];
    $email = $_POST['email'];
    $phone = $_POST['number'];
    $password = $_POST['pass'];
    $cpassword = $_POST['cpass'];
    
    if($password != $cpassword) {
        header("Location: userSignup.html?error=passwordmismatch");
        exit();
    }

    $hpassword = password_hash($password, PASSWORD_DEFAULT);
    $checkEmail = "SELECT * FROM normal_user WHERE Email='$email'";
    $result = $conn->query($checkEmail);
    
    if($result->num_rows > 0) {
        header("Location: userSignup.html?error=emailexists");
        exit();
    }
    else {
        $insertQuery = "INSERT INTO `normal_user` (`Full Name`, `Email`, `Phone No`, `Password`) 
                       VALUES (?, ?, ?, ?)";
        
        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssss", $name, $email, $phone, $hpassword);
        
        if($stmt->execute()) {
            header("Location: userSignup.html?success=1");
            exit();
        }
        else {
            header("Location: userSignup.html?error=dberror");
            exit();
        }
    }
}

if(isset($_POST['signIn'])) {
    // Login handling
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM normal_user WHERE Email=?";
    
    // Use prepared statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Debug output (remove in production)
        echo "Stored hash: " . $row['Password'] . "<br>";
        echo "Input password: " . $password . "<br>";
        
        if(password_verify($password, $row['Password'])) {
            $_SESSION['email'] = $row['Email'];
            $_SESSION['user_id'] = $row['id']; // Assuming you have an id column
            header("Location: homepage.php");
            exit();
        }
        else {
            echo "<script>alert('Wrong Password try again'); window.location.href='userLogin.html?error=invalidpassword';</script>";
            exit();
        }
    }
    else {
        header("Location: userLogin.html?error=emailnotfound");
        exit();
    }
}
?>