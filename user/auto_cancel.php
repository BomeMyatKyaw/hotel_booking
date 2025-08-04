<?php
include('../includes/db.php');

$today = date('Y-m-d');

$sql = "UPDATE bookings 
        SET status = 'cancelled', status_reason = 'Auto-cancelled after expiry'
        WHERE check_out < ? AND status = 'pending'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $today);
$stmt->execute();
$stmt->close();
?>