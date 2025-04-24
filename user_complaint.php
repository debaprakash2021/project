<?php
session_start();
include 'connect.php';
// Get logged-in user's email
$user_email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $complaint_type = $_POST['complaint_type'];
    $complaint_text = $_POST['complaint_text'];
    
    // Validate input
    if (empty($complaint_type) || empty($complaint_text)) {
        $error = "Please fill in all fields";
    } elseif (str_word_count($complaint_text) > 250) {
        $error = "Complaint must be 250 words or less";
    } else {
        // Save complaint with user's email
        $stmt = $conn->prepare("INSERT INTO complaints (user_email, complaint_type, complaint_text) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user_email, $complaint_type, $complaint_text);
        
        if ($stmt->execute()) {
            echo "<script>alert('Complaint Submitted Successfully'); window.location.href='Homepage.html';</script>";
            exit();
        } else {
            $error = "Error submitting complaint: " . $conn->error;
        }
    }
}
?>