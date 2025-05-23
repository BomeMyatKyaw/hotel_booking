<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}
$pageTitle = "Dashboard Overview";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?></title>
    <style>
        :root {
            --sidebar-bg: #1e293b;
            --sidebar-text: #cbd5e1;
            --sidebar-active: #3b82f6;
            --main-bg: #f1f5f9;
            --card-bg: #ffffff;
            --text-color: #1e293b;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            min-height: 100vh;
            background-color: var(--main-bg);
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            display: flex;
            flex-direction: column;
            padding-top: 20px;
            position: fixed;
            height: 100%;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #fff;
        }

        .sidebar a {
            padding: 15px 30px;
            text-decoration: none;
            color: var(--sidebar-text);
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: var(--sidebar-active);
            color: #fff;
        }

        /* Main content */
        .main {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
        }

        .topbar {
            background: #fff;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar h1 {
            margin: 0;
            font-size: 24px;
            color: var(--text-color);
        }

        .card {
            background-color: var(--card-bg);
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .card h3 {
            margin: 0 0 10px;
            color: var(--text-color);
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                flex-direction: row;
                overflow-x: auto;
            }

            .main {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <?php include('layouts/sidebar.php'); ?>
    <div class="main">
        <?php include('layouts/header.php'); ?>

        <div class="card">
            <h3>Total Users</h3>
            <p>1,203 users</p>
        </div>

        <div class="card">
            <h3>Revenue</h3>
            <p>$24,500 this month</p>
        </div>

        <div class="card">
            <h3>Notifications</h3>
            <p>No new alerts</p>
        </div>
    </div>

    <script>
        // Grab all sidebar links
        const sidebarLinks = document.querySelectorAll('.sidebar a');

        // Loop through each link and attach a click event
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function () {
                // Remove active class from all links
                sidebarLinks.forEach(l => l.classList.remove('active'));
                // Add active to the clicked link
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>