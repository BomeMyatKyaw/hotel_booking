<?php
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: ../index.php');
        exit;
    }

    include('../includes/db.php'); // ✅ Add this line

    $pageTitle = "Dashboard Overview";

    // Count total active users
    $userQuery = $conn->query("SELECT COUNT(*) as total_users FROM users WHERE status = 'active'");
    $userData = $userQuery->fetch_assoc();
    $totalUsers = $userData['total_users'] ?? 0;

    // Calculate total revenue from bookings (example table: bookings)
    $revenueQuery = $conn->query("SELECT SUM(total_price) as total_revenue FROM bookings");
    $revenueData = $revenueQuery->fetch_assoc();
    $totalRevenue = $revenueData['total_revenue'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="../assets/css/dashboardstyle.css" />
</head>
<body>
    <?php include('layouts/sidebar.php'); ?>
    <div class="main">
        <?php include('layouts/header.php'); ?>

        <div class="card">
            <h3>Total Users</h3>
            <p><?= number_format($totalUsers) ?> users</p>
        </div>

        <div class="card">
            <h3>Revenue</h3>
            <p><?= number_format($totalRevenue, 2) ?> Ks this month</p>
        </div>

        <div class="card">
            <h3>Notifications</h3>
            <p>No new alerts</p>
        </div>
    </div>

    <script>
        const sidebarLinks = document.querySelectorAll('.sidebar a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function () {
                sidebarLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>
