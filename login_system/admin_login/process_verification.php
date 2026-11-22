<?php
session_start();
include '../backend/connection.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = (int)$_GET['id'];
    $action = $_GET['action'] === 'approve' ? 'approved' : 'declined';

    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare("UPDATE verification_requests SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $action, $id);
        $stmt->execute();
        $stmt->close();

        if ($action === 'approved') {
            $stmtUser = $conn->prepare("SELECT email FROM verification_requests WHERE id = ?");
            $stmtUser->bind_param("i", $id);
            $stmtUser->execute();
            $res = $stmtUser->get_result();
            if ($row = $res->fetch_assoc()) {
                $userEmail = $row['email'];
                $updateUser = $conn->prepare("UPDATE users SET payment_status = 1 WHERE email = ?");
                $updateUser->bind_param("s", $userEmail);
                $updateUser->execute();
                $updateUser->close();
            }
            $stmtUser->close();
        }

        $conn->commit();
        $_SESSION['admin_msg'] = "Request #$id successfully marked as $action.";
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['admin_err'] = "Failed to process request: " . $e->getMessage();
    }
}

header("Location: admin_dashboard.php");
exit();
?>
