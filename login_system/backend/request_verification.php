<?php
session_start();
include 'connection.php';

if (!isset($_SESSION["email"])) {
    header("Location: ../index.php");
    exit();
}

$email = $_SESSION["email"];

// Check if the user already has a pending request
$query = $conn->prepare("SELECT status, TIMESTAMPDIFF(MINUTE, request_time, NOW()) AS minutes_elapsed FROM verification_requests WHERE email = ? ORDER BY request_time DESC LIMIT 1");
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();

if ($row) {
    if ($row['status'] == 'pending' && $row['minutes_elapsed'] < 30) {
        $_SESSION['message'] = "You must wait 30 minutes before making another request.";
        $_SESSION['message_type'] = "warning";
        header("Location: ../../dashboard.php");
        exit();
    } elseif ($row['status'] == 'approved') {
        $_SESSION['message'] = "Your last request was already approved!";
        $_SESSION['message_type'] = "success";
        header("Location: ../../dashboard.php");
        exit();
    }
}

// Insert new verification request
$insertQuery = $conn->prepare("INSERT INTO verification_requests (email, status, request_time) VALUES (?, 'pending', NOW())");
$insertQuery->bind_param("s", $email);
if ($insertQuery->execute()) {
    $_SESSION['message'] = "Verification request submitted! Please wait for admin approval.";
    $_SESSION['message_type'] = "success";
} else {
    $_SESSION['message'] = "Error submitting verification request. Try again later.";
    $_SESSION['message_type'] = "danger";
}

header("Location: ../../dashboard.php");
exit();
?>

