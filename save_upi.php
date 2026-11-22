<?php
session_start();
header('Content-Type: application/json');
include 'login_system/backend/connection.php';

if (!isset($_SESSION["email"])) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Unauthorized request! Please log in."]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method not allowed"]);
    exit();
}

$email = filter_var($_SESSION["email"], FILTER_SANITIZE_EMAIL);
$upi_id = trim($_POST["upi_id"] ?? "");
$amount = floatval($_POST["amount"] ?? 0);

if (empty($upi_id) || $amount <= 0) {
    http_response_code(422);
    echo json_encode(["status" => "error", "message" => "Invalid UPI ID or amount"]);
    exit();
}

$stmt = $conn->prepare("INSERT INTO verification_requests (email, upi_id, amount, status, request_time) VALUES (?, ?, ?, 'pending', NOW())");
$amountInt = (int)$amount;
$stmt->bind_param("ssi", $email, $upi_id, $amountInt);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "UPI payment submitted successfully! Verification request pending admin approval."]);
} else {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Error submitting verification request. Please try again."]);
}
$stmt->close();
$conn->close();
?>
