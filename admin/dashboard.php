<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .dashboard-content {
            padding: 20px;
        }
        .card-title {
            font-size: 1.25rem;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <h4 class="text-center mb-4">Admin Panel</h4>
            <a href="dashboard.php">Dashboard</a>
            <a href="manage_hotels.php">Manage Hotels</a>
            <a href="manage_room.php">Manage Rooms</a>
            <!-- Add more links here as needed -->
            <a href="../index.php">Back to Site</a>
            <a href="../auth/logout.php">Logout</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 dashboard-content">
            <h2 class="mb-4">Welcome, Admin!</h2>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h5 class="card-title">Manage Hotels</h5>
                            <p class="card-text">View, add, edit or delete hotels.</p>
                            <a href="manage_hotels.php" class="btn btn-primary">Go to Hotels</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-success">
                        <div class="card-body">
                            <h5 class="card-title">Manage Rooms</h5>
                            <p class="card-text">Add and manage rooms for hotels.</p>
                            <a href="manage_room.php" class="btn btn-success">Go to Rooms</a>
                        </div>
                    </div>
                </div>
                <!-- Add more dashboard cards as needed -->
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
