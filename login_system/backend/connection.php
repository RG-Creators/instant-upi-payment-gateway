<?php
$host = "localhost";
$username = "root"; // Change if using a different username
$password = ""; // Add your database password if any
$database = "pay";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    echo "<script>alert('There is a server problem. Please try again later.'); window.location.href='../index.php';</script>";
    exit();
}
?>
