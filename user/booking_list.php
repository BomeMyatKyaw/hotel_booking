<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle cancel booking
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_booking_id'])) {
    $cancel_id = intval($_POST['cancel_booking_id']);
    $conn->query("DELETE FROM bookings WHERE id = $cancel_id AND user_id = $user_id");
    header("Location: booking_list.php");
    exit();
}

// Fetch bookings
$sql = "SELECT bookings.*, hotels.name AS hotel_name FROM bookings 
        JOIN hotels ON bookings.hotel_id = hotels.id
        WHERE bookings.user_id = $user_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        main { padding: 20px; }
        .table th, .table td { vertical-align: middle; }
        .btn-info, .btn-danger { font-size: 0.9rem; padding: 0.4rem 1rem; }
        .modal-content { border-radius: 10px; }
        .modal-header { background-color: #343a40; color: #fff; }
        .modal-footer button { border-radius: 50px; }
        .back-btn { border-radius: 50px; }
    </style>
</head>
<body>

<main>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-center">Your Bookings</h2>
        <a href="../index.php" class="btn btn-danger back-btn">Back to Home</a>
    </div>

    <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Hotel</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Total Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($booking = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking['hotel_name']); ?></td>
                        <td><?= htmlspecialchars($booking['check_in']); ?></td>
                        <td><?= htmlspecialchars($booking['check_out']); ?></td>
                        <td>$<?= number_format($booking['total_price'], 2); ?></td>
                        <td>
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#bookingModal<?= $booking['id']; ?>">View Details</button>
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
                                    <p><strong>Hotel Name:</strong> <?= htmlspecialchars($booking['hotel_name']); ?></p>
                                    <p><strong>Check-in Date:</strong> <?= htmlspecialchars($booking['check_in']); ?></p>
                                    <p><strong>Check-out Date:</strong> <?= htmlspecialchars($booking['check_out']); ?></p>
                                    <p><strong>Total Price:</strong> $<?= number_format($booking['total_price'], 2); ?></p>
                                    <p><strong>Booking Created On:</strong> <?= htmlspecialchars($booking['created']); ?></p>
                                    <p><strong>Last Updated On:</strong> <?= htmlspecialchars($booking['updated']); ?></p>
                                </div>
                                <div class="modal-footer d-flex justify-content-end">
                                    <form method="POST">
                                        <input type="hidden" name="cancel_booking_id" value="<?= $booking['id']; ?>">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel Booking</button>
                                    </form>
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
        <div class="alert alert-warning" role="alert">
            No bookings found.
        </div>
    <?php endif; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>
