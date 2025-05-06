<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}
?>
<h1>Admin Dashboard</h1>
<a href="manage_hotels.php">Manage Hotels</a>
<a href="view_bookings.php">View Bookings</a>
