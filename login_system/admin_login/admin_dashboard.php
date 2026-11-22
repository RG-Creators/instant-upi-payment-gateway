<?php
session_start();
include '../backend/connection.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch pending requests
$query = "SELECT * FROM verification_requests WHERE status = 'pending'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .dashboard-container {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 900px;
            text-align: center;
            position: relative;
        }
        .dashboard-container h2 {
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        /* Three-Dot Menu */
        .menu-container {
            position: absolute;
            top: 15px;
            right: 15px;
        }
        .dropdown-menu {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.3s ease-in-out;
        }
        .logout-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #dc3545;
            font-weight: 600;
            transition: 0.3s ease-in-out;
        }
        .logout-btn:hover {
            background: #dc3545;
            color: white;
        }
        .logout-btn i {
            font-size: 18px;
        }
        .table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        .table th {
            background: #764ba2;
            color: white;
        }
        .table tbody tr:hover {
            background: #f2f2f2;
        }
        .btn-action {
            border-radius: 20px;
            padding: 6px 15px;
            font-size: 14px;
            transition: 0.3s;
        }
        .btn-approve {
            background: #28a745;
            color: white;
        }
        .btn-approve:hover {
            background: #218838;
        }
        .btn-decline {
            background: #dc3545;
            color: white;
        }
        .btn-decline:hover {
            background: #c82333;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

    <div class="dashboard-container">
        <!-- Three-Dot Menu -->
        <div class="menu-container">
            <div class="dropdown">
                <button class="btn btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    &#x22EE;
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item logout-btn" href="logout.php">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <h2>Payment Verification Requests</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Request Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= $row['request_time'] ?></td>
                        <td>
                            <a href="process_verification.php?id=<?= $row['id'] ?>&action=approve" class="btn btn-action btn-approve">Approve</a>
                            <a href="process_verification.php?id=<?= $row['id'] ?>&action=decline" class="btn btn-action btn-decline">Decline</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
