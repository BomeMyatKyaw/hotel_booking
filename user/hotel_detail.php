<?php
session_start();
include('../includes/db.php');

// Check for hotel_id
if (!isset($_GET['hotel_id'])) {
    header("Location: hotels.php");
    exit();
}

$hotel_id = (int)$_GET['hotel_id'];

// Fetch hotel
$hotel = $conn->query("SELECT * FROM hotels WHERE id = $hotel_id")->fetch_assoc();
if (!$hotel) {
    echo "Hotel not found.";
    exit();
}

// Fetch rooms
$stmt = $conn->prepare("
    SELECT r.*, 
       (r.total_rooms - IFNULL(SUM(CASE WHEN b.status != 'cancelled' THEN b.num_rooms ELSE 0 END), 0)) AS available_rooms
    FROM rooms r
    LEFT JOIN bookings b ON r.id = b.room_id
    WHERE r.hotel_id = ?
    GROUP BY r.id
");
$stmt->bind_param("ii", $hotel_id, $hotel_id);
$stmt->execute();
$rooms = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($hotel['name']) ?> - Rooms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4"><?= htmlspecialchars($hotel['name']) ?> - Rooms</h2>
    <p><?= nl2br(htmlspecialchars($hotel['description'])) ?></p>
    <a href="hotels.php" class="btn btn-secondary mb-4">← Back to Hotels</a>

    <div class="row">
        <?php $hasRoom = false; ?>
        <?php while ($room = $rooms->fetch_assoc()): ?>
            <?php
                if ((int)$room['total_rooms'] <= 0) continue;
                $hasRoom = true;
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

    <?php if (!$hasRoom): ?>
        <p class="text-muted">No rooms available for this hotel.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
