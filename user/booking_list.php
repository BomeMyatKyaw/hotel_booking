<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

// Fetch all bookings for the logged-in user and join with hotels table to get hotel names
$user_id = $_SESSION['user_id'];
$sql = "SELECT bookings.*, hotels.name AS hotel_name FROM bookings 
        JOIN hotels ON bookings.hotel_id = hotels.id
        WHERE bookings.user_id = $user_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        main {
            padding: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f1f3f5;
        }
        .btn-info {
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
                                <td><?php echo htmlspecialchars($booking['hotel_name']); ?></td>
                                <td><?php echo htmlspecialchars($booking['check_in']); ?></td>
                                <td><?php echo htmlspecialchars($booking['check_out']); ?></td>
                                <td>$<?php echo number_format($booking['total_price'], 2); ?></td>
                                <td>
                                    <!-- Button to trigger modal -->
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#bookingModal<?php echo $booking['id']; ?>">View Details</button>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="bookingModal<?php echo $booking['id']; ?>" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="bookingModalLabel">Booking Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Hotel Name:</strong> <?php echo htmlspecialchars($booking['hotel_name']); ?></p>
                                            <p><strong>Check-in Date:</strong> <?php echo htmlspecialchars($booking['check_in']); ?></p>
                                            <p><strong>Check-out Date:</strong> <?php echo htmlspecialchars($booking['check_out']); ?></p>
                                            <p><strong>Total Price:</strong> $<?php echo number_format($booking['total_price'], 2); ?></p>
                                            <p><strong>Booking Created On:</strong> <?php echo htmlspecialchars($booking['created']); ?></p>
                                            <p><strong>Last Updated On:</strong> <?php echo htmlspecialchars($booking['updated']); ?></p>
                                        </div>
                                        <div class="modal-footer">
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

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>
