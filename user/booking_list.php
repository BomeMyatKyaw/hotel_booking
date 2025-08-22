<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['cancel_booking_id'])){
    $cancel_id = intval($_POST['cancel_booking_id']);

    // Fetch room_id and num_rooms from the booking being cancelled
    $booking_sql = "SELECT room_id, num_rooms FROM bookings WHERE id = $cancel_id AND user_id = $user_id AND status != 'cancelled'";
    $booking_result = $conn->query($booking_sql);

    if ($booking_result && $booking_result->num_rows > 0){
        $booking = $booking_result->fetch_assoc();
        $room_id = $booking['room_id'];
        $num_rooms = $booking['num_rooms'];

        // Update the booking status
        $conn->query("UPDATE bookings SET status = 'cancelled' WHERE id = $cancel_id AND user_id = $user_id");

        // Restore room availability
        $conn->query("UPDATE rooms SET available_rooms = available_rooms + $num_rooms WHERE id = $room_id");
    }

    header("Location: booking_list.php");
    exit();
}


    if (isset($_POST['pay_booking_id'])){
        $pay_id = intval($_POST['pay_booking_id']);
        $conn->query("UPDATE bookings SET status = 'paid' WHERE id = $pay_id AND user_id = $user_id");
        header("Location: booking_list.php");
        exit();
    }
}

// Fetch bookings
$sql = "SELECT bookings.*, hotels.name AS hotel_name, rooms.name AS room_name 
        FROM bookings 
        JOIN hotels ON bookings.hotel_id = hotels.id 
        JOIN rooms ON bookings.room_id = rooms.id 
        WHERE bookings.user_id = $user_id 
        ORDER BY bookings.created DESC";
$result = $conn->query($sql);


// Auto-cancel expired unpaid bookings
$today = date('Y-m-d');
$conn->query("
    UPDATE bookings 
    SET status = 'cancelled' 
    WHERE user_id = $user_id 
      AND status = 'unpaid' 
      AND check_out < '$today'
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        body { 
            background-color: #f8f9fa; 
        }

        main { 
            padding: 20px; 
        }

        .btn-sm { 
            font-size: 0.9rem; 
            padding: 0.35rem 0.75rem; 
        }

        .badge { 
            font-size: 0.85rem; 
        }

        .modal-content { 
            border-radius: 10px; 
        }

        .modal-header { 
            background-color: #343a40; 
            color: #fff; 
        }

        .back-btn { 
            border-radius: 50px; 
        }

        form { 
            display: inline-block; 
            margin-right: 4px; 
        }

    </style>
</head>
<body>

<main>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-center flex-grow-1">Your Bookings</h2>
        <a href="../index.php" class="btn btn-danger back-btn ms-3">Back to Home</a>
    </div>

    <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Hotel</th>
                        <th>Room</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($booking = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking['hotel_name']); ?></td>
                        <td><?= htmlspecialchars($booking['room_name']); ?></td>
                        <td><?= htmlspecialchars($booking['check_in']); ?></td>
                        <td><?= htmlspecialchars($booking['check_out']); ?></td>
                        <td><?= number_format($booking['total_price'], 0); ?>Ks</td>
                        <td>
                            <?php
                                $status = $booking['status'];
                                if ($status === 'paid') {
                                    echo '<span class="badge bg-success">Paid</span>';
                                } elseif ($status === 'cancelled') {
                                    echo '<span class="badge bg-danger">Cancelled</span>';
                                } else {
                                    echo '<span class="badge bg-warning text-dark">Unpaid</span>';
                                }
                            ?>
                        </td>
                        <td>
                            <!-- View Button -->
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#bookingModal<?= $booking['id']; ?>">View</button>

                            <!-- Pay Button -->
                            <form method="POST">
                                <input type="hidden" name="pay_booking_id" value="<?= $booking['id']; ?>">
                                <button type="submit" class="btn btn-success btn-sm"
                                    <?= ($status !== 'unpaid') ? 'disabled title="Payment not allowed for this booking"' : 'onclick="return confirm(\'Confirm payment?\')"' ?>>
                                    Pay
                                </button>
                            </form>

                            <!-- Cancel Button -->
                            <form method="POST">
                                <input type="hidden" name="cancel_booking_id" value="<?= $booking['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm"
                                    <?= ($status !== 'unpaid') ? 'disabled title="Cancellation not allowed for this booking"' : 'onclick="return confirm(\'Are you sure you want to cancel this booking?\')"' ?>>
                                    Cancel
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="bookingModal<?= $booking['id']; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Booking Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Hotel Name:</strong> <?= htmlspecialchars($booking['hotel_name']); ?></p>
                                    <p><strong>Room Name:</strong> <?= htmlspecialchars($booking['room_name']); ?></p>
                                    <p><strong>Check-in:</strong> <?= htmlspecialchars($booking['check_in']); ?></p>
                                    <p><strong>Check-out:</strong> <?= htmlspecialchars($booking['check_out']); ?></p>
                                    <p><strong>Total Price:</strong> $<?= number_format($booking['total_price'], 0); ?></p>
                                    <p><strong>Status:</strong>
                                        <?php
                                        if ($status === 'paid') {
                                            echo '<span class="text-success">Paid</span>';
                                        } elseif ($status === 'cancelled') {
                                            echo '<span class="text-danger">Cancelled</span>';
                                        } else {
                                            echo '<span class="text-warning">Unpaid</span>';
                                        }
                                        ?>
                                    </p>
                                    <p><strong>Created:</strong> <?= htmlspecialchars($booking['created']); ?></p>
                                    <p><strong>Updated:</strong> <?= htmlspecialchars($booking['updated']); ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center" role="alert">
            No bookings found.
        </div>
    <?php endif; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
