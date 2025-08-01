<?php
session_start();
include('../includes/db.php');

$hotel_id = (int)$_GET['hotel_id'];
$hotel = $conn->query("SELECT * FROM hotels WHERE id = $hotel_id")->fetch_assoc();
$images = $conn->query("SELECT image FROM hotel_images WHERE hotel_id = $hotel_id");

$rooms = $conn->query("SELECT r.*, (
    SELECT IFNULL(SUM(b.num_rooms), 0)
    FROM bookings b
    WHERE b.room_id = r.id
      AND b.check_in <= CURDATE()
      AND b.check_out > CURDATE()
) AS booked_rooms FROM rooms r WHERE r.hotel_id = $hotel_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f1f3f5;
        }

        .hotel-card { 
            background: #fff;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }

        .carousel img { 
            height: 330px;
            object-fit: cover;
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
        }

        .room-card:hover { 
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="py-4">
    <div class="container px-4">
        <a href="./hotels.php" class="btn btn-outline-secondary mb-4">&larr; Back to Hotels</a>

        <div class="hotel-card">
            <h2 class="mb-3"><?= htmlspecialchars($hotel['name']) ?></h2>
            <p class="text-muted"><?= nl2br(htmlspecialchars($hotel['description'])) ?></p>

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
                            <?php $isFirst = true; while ($img = $images->fetch_assoc()): ?>
                                <div class="carousel-item <?= $isFirst ? 'active' : '' ?>">
                                    <img src="../images/<?= htmlspecialchars($img['image']) ?>" class="d-block w-100 rounded" alt="Hotel Image">
                                </div>
                                <?php $isFirst = false; endwhile; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#hotelImagesCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#hotelImagesCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <a href="../admin/edit_hotel.php?id=<?= $hotel_id ?>" class="btn btn-warning">Edit Hotel</a>
                <?php endif; ?>
            </div>

            <hr>

            <h4 class="mb-3">Available Rooms</h4>
            <?php if ($rooms->num_rows > 0): ?>
                <div class="row g-3">
                    <?php while ($room = $rooms->fetch_assoc()): ?>
                        <?php $isFull = $room['booked_rooms'] >= $room['total_rooms']; ?>
                        <div class="col-md-4">
                            <div class="room-card">
                                <h5><?= htmlspecialchars($room['name']) ?></h5>
                                <p class="mb-1"><strong>Room Type:</strong> <?= htmlspecialchars($room['room_type']) ?></p>
                                <p class="mb-1"><strong>Capacity:</strong> <?= (int)$room['max_guests'] ?> persons</p>
                                <p class="mb-1"><strong>Price:</strong> <span class="text-success"><?= number_format($room['price'], 2) ?> Ks</span></p>
                                <p class="mb-1"><strong>Available:</strong> <?= max(0, $room['total_rooms'] - $room['booked_rooms']) ?> rooms</p>
                                <?php if ($isFull): ?>
                                    <button class="btn btn-secondary" disabled>Full</button>
                                <?php else: ?>
                                    <a href="booking.php?hotel_id=<?= $hotel_id ?>&room_id=<?= $room['id'] ?>" class="btn btn-primary">Book Now</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p class="text-muted">No rooms available for this hotel.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
