<?php
session_start();
include('../includes/db.php');

// Check for hotel_id
if (!isset($_GET['hotel_id'])){
    header("Location: hotels.php");
    exit();
}

$hotel_id = (int)$_GET['hotel_id'];

// Fetch hotel
$hotel = $conn->query("SELECT * FROM hotels WHERE id = $hotel_id")->fetch_assoc();
if (!$hotel){
    echo "Hotel not found.";
    exit();
}

// Fetch images
$imagesStmt = $conn->prepare("SELECT * FROM hotel_images WHERE hotel_id = ?");
$imagesStmt->bind_param("i", $hotel_id);
$imagesStmt->execute();
$images = $imagesStmt->get_result();

// Fetch rooms with booking info
$stmt = $conn->prepare("
    SELECT 
        r.*, 
        IFNULL(SUM(CASE WHEN b.status != 'cancelled' THEN b.num_rooms ELSE 0 END), 0) AS booked_rooms,
        (r.total_rooms - IFNULL(SUM(CASE WHEN b.status != 'cancelled' THEN b.num_rooms ELSE 0 END), 0)) AS available_rooms
    FROM rooms r
    LEFT JOIN bookings b ON r.id = b.room_id
    WHERE r.hotel_id = ?
    GROUP BY r.id
");
$stmt->bind_param("i", $hotel_id);
$stmt->execute();
$rooms = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($hotel['name']) ?> - Rooms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f3f5;
        }

        .hotel-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            transition: 0.3s ease;
        }

        .hotel-card:hover {
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
            transform: translateY(-3px);
        }

        .hotel-card img {
            border-radius: 12px;
            height: 200px;
            object-fit: cover;
            width: 100%;
            margin-bottom: 12px;
        }

        .hotel-card h5 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .hotel-card p {
            color: #555;
            font-size: 14px;
        }

        .btn-primary, .btn-secondary {
            border-radius: 8px;
        }

        .container {
            padding-top: 32px;
            padding-bottom: 32px;
        }

        .map-responsive {
            overflow: hidden;
            padding-bottom: 56.25%;
            position: relative;
            height: 0;
        }

        .map-responsive iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        .room-card {
            border: 1px solid #dee2e6;
            border-radius: 12px;
            padding: 16px;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            transition: 0.2s;
            height: 100%;
        }

        .room-card:hover {
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }

        .carousel-inner img {
            height: 358px;
            object-fit: cover;
            width: 100%;
            border-radius: 12px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <a href="hotels.php" class="btn btn-secondary mb-4">← Back to Hotels</a>
    <h2 class="mb-4"><?= htmlspecialchars($hotel['name']) ?> - Rooms</h2>
    <p><?= nl2br(htmlspecialchars($hotel['description'])) ?></p>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <h5 class="mb-2">Location</h5>
            <div class="map-responsive rounded overflow-hidden shadow-sm">
                <?= $hotel['location_embed'] ?>
            </div>
        </div>

        <div class="col-md-6">
            <h5 class="mb-2">Hotel Images</h5>
            <div id="hotelImagesCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner rounded">
                    <?php if ($images->num_rows === 0): ?>
                        <div class="carousel-item active">
                            <img src="../images/<?= htmlspecialchars($img['image']) ?>" class="d-block w-100 rounded" alt="Hotel Image" style="height: 320px; object-fit: cover;">
                        </div>
                    <?php else: ?>
                        <?php $isFirst = true; ?>
                        <?php while ($img = $images->fetch_assoc()): ?>
                            <div class="carousel-item <?= $isFirst ? 'active' : '' ?>">
                                <img src="../images/<?= htmlspecialchars($img['image']) ?>" class="d-block w-100 rounded" alt="Hotel Image">
                            </div>
                            <?php $isFirst = false; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <?php if ($images->num_rows > 1): ?>
                    <button class="carousel-control-prev" type="button" data-bs-target="#hotelImagesCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#hotelImagesCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <?php $hasRoom = false; ?>
        <?php while ($room = $rooms->fetch_assoc()): ?>
            <?php
                if ((int)$room['total_rooms'] <= 0) continue;
                $hasRoom = true;
                $isFull = $room['available_rooms'] <= 0;
            ?>
            <div class="col-md-4 mb-3 d-flex">
                <div class="room-card w-100 d-flex flex-column">
                    <div class="flex-grow-1">
                        <h5><strong><?= htmlspecialchars($room['name']) ?></strong></h5>
                        <p><?= htmlspecialchars($room['description']) ?></p>
                        <div class="d-flex justify-content-between">
                            <span><strong>Price : </strong> <?= number_format($room['price']) ?> Ks</span>

                            <p class="me-3"><strong>Max Guest : </strong> <?= number_format($room['max_guests'])?></p>
                        </div>
                        <p><strong>Available : </strong> <?= max(0, $room['available_rooms']) ?> / <?= $room['total_rooms'] ?></p>
                    </div>
                    <div>
                        <?php if ($isFull): ?>
                            <button class="btn btn-secondary w-100" disabled>Full</button>
                        <?php else: ?>
                            <a href="booking.php?hotel_id=<?= $hotel['id'] ?>&room_id=<?= $room['id'] ?>" class="btn btn-primary w-100">Book Now</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>

        <?php if (!$hasRoom): ?>
            <p class="text-muted">No rooms available for this hotel.</p>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
