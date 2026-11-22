<?php
session_start(); // Start session
require "connection.php"; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check if email exists in the database
    $sql = "SELECT email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify entered password with the stored hashed password
        if (password_verify($password, $hashed_password)) {
            // Secure session fixation
            session_regenerate_id(true);
            $_SESSION["email"] = $email; // Store email in session
            header("Location: ../../dashboard.php"); // Redirect to makepay.php (Outside backend folder)
            exit();
        } else {
            echo "<script>alert('Invalid password. Please try again!'); window.location.href='../index.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Email not found. Please sign up first!'); window.location.href='../index.php';</script>";
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
