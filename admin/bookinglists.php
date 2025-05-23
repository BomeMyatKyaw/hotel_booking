<?php
session_start();
include('../includes/db.php');

$pageTitle = "Booking Lists";

// Fetch all bookings with user and hotel info
$sql = "SELECT bookings.*, hotels.name AS hotel_name, users.username
        FROM bookings 
        JOIN hotels ON bookings.hotel_id = hotels.id 
        JOIN users ON bookings.user_id = users.id 
        ORDER BY bookings.created DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Lists</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/dashboardstyle.css" />

    <style>
        body { 
            background-color: #f8f9fa; 
        }
        .main { 
            margin-left: 250px;
        }
        .table th, .table td { 
            vertical-align: middle; 
        }
        .btn-info, .btn-danger { 
            font-size: 0.9rem; 
            padding: 0.4rem 1rem; 
        }
        .modal-content { 
            border-radius: 10px; 
        }
        .modal-header { 
            background-color: #343a40; 
            color: #fff; 
        }
        .modal-footer button { 
            border-radius: 50px; 
        }
        .back-btn { 
            border-radius: 50px; 
        }
    </style>
</head>
<body>

<?php include('layouts/sidebar.php'); ?>
<div class="main">
    <?php include('layouts/header.php'); ?>
    
    <div class="container-fluid mt-4">

        <?php if ($result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Hotel</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($booking = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($booking['username']); ?></td>
                            <td><?= htmlspecialchars($booking['hotel_name']); ?></td>
                            <td><?= htmlspecialchars($booking['check_in']); ?></td>
                            <td><?= htmlspecialchars($booking['check_out']); ?></td>
                            <td>$<?= number_format($booking['total_price'], 2); ?></td>
                            <td>
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#bookingModal<?= $booking['id']; ?>">View</button>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="bookingModal<?= $booking['id']; ?>" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bookingModalLabel">Booking Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>User:</strong> <?= htmlspecialchars($booking['username']); ?></p>
                                        <p><strong>Hotel:</strong> <?= htmlspecialchars($booking['hotel_name']); ?></p>
                                        <p><strong>Check-in:</strong> <?= htmlspecialchars($booking['check_in']); ?></p>
                                        <p><strong>Check-out:</strong> <?= htmlspecialchars($booking['check_out']); ?></p>
                                        <p><strong>Total Price:</strong> $<?= number_format($booking['total_price'], 2); ?></p>
                                        <p><strong>Created On:</strong> <?= htmlspecialchars($booking['created']); ?></p>
                                        <p><strong>Updated On:</strong> <?= htmlspecialchars($booking['updated']); ?></p>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between">
                                        <!-- <form method="POST">
                                            <input type="hidden" name="cancel_booking_id" value="<?= $booking['id']; ?>">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel Booking</button>
                                        </form> -->
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">No bookings found.</div>
        <?php endif; ?>

    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>
