<?php
session_start();
include('../includes/db.php');

// Fetch all hotels
$hotels = $conn->query("SELECT * FROM hotels");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Available Hotels</h2>

    <?php while ($hotel = $hotels->fetch_assoc()): ?>
        <div class="card mb-4">
            <div class="card-header">
                <h4><?= htmlspecialchars($hotel['name']) ?></h4>
            </div>
            <div class="card-body">
                <p><?= nl2br(htmlspecialchars($hotel['description'])) ?></p>

                <?php
                // Fetch rooms for this hotel
                $stmt = $conn->prepare("
                    SELECT r.*, 
                           IFNULL(SUM(b.num_rooms), 0) AS booked_rooms 
                    FROM rooms r
                    LEFT JOIN bookings b ON r.id = b.room_id
                        AND b.hotel_id = ?
                    WHERE r.hotel_id = ?
                    GROUP BY r.id
                ");
                $stmt->bind_param("ii", $hotel['id'], $hotel['id']);
                $stmt->execute();
                $rooms = $stmt->get_result();

                $validRoomCount = 0;
                ?>

                <?php if ($rooms->num_rows > 0): ?>
                    <div class="row">
                        <?php while ($room = $rooms->fetch_assoc()): ?>
                            <?php
                                if ((int)$room['total_rooms'] <= 0) continue;
                                $validRoomCount++;
                                $isFull = $room['booked_rooms'] >= $room['total_rooms'];
                            ?>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($room['name']) ?></h5>
                                        <p class="card-text"><?= htmlspecialchars($room['description']) ?></p>
                                        <p class="card-text">Price: <?= number_format($room['price']) ?> Ks</p>
                                        <p class="card-text">Available: <?= max(0, $room['total_rooms'] - $room['booked_rooms']) ?> / <?= $room['total_rooms'] ?></p>
                                    </div>
                                    <div class="card-footer">
                                        <?php if ($isFull): ?>
                                            <button class="btn btn-secondary w-100" disabled>Full</button>
                                        <?php else: ?>
                                            <a href="booking.php?hotel_id=<?= $hotel['id'] ?>&room_id=<?= $room['id'] ?>" class="btn btn-primary w-100">Book Now</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <?php if ($validRoomCount === 0): ?>
                        <p class="text-muted">No rooms available for this hotel.</p>
                    <?php endif; ?>
                <?php else: ?>
                    <p class="text-muted">No rooms available for this hotel.</p>
                <?php endif; ?>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
