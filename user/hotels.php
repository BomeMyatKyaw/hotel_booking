<?php
session_start();
include('../includes/db.php');

// $sql = "SELECT * FROM hotels";
// $result = $conn->query($sql);

$sql = "
    SELECT h.id, h.name, h.description,
           IFNULL(SUM(r.total_rooms), 0) AS total_rooms,
           IFNULL(SUM(b.num_rooms), 0) AS booked_rooms
    FROM hotels h
    LEFT JOIN rooms r ON r.hotel_id = h.id
    LEFT JOIN bookings b ON b.room_id = r.id
        AND b.check_in <= CURDATE() AND b.check_out > CURDATE()
    GROUP BY h.id
";

$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        body {
            background-color: #f8f9fa;
        }

        .hotel-card {
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .hotel-card:hover {
            transform: translateY(-5px);
        }

        .carousel-inner img {
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px;
            margin-top: 40px;
        }
        
    </style>
</head>
<body>

<main class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Available Hotels</h2>
        <a href="../index.php" class="btn btn-danger">Back to Home</a>
    </div>

    <div class="row g-3">
        <?php while ($hotel = $result->fetch_assoc()): ?>
            <?php $images = $conn->query("SELECT image FROM hotel_images WHERE hotel_id = {$hotel['id']}"); ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card hotel-card h-100">
                    <!-- Carousel -->
                    <div id="carouselHotel<?= $hotel['id'] ?>" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" style="height: 160px;">
                            <?php $first = true; while ($img = $images->fetch_assoc()): ?>
                                <div class="carousel-item <?= $first ? 'active' : '' ?>">
                                    <img src="../images/<?= htmlspecialchars($img['image']) ?>" class="d-block w-100" style="height: 160px; object-fit: cover;">
                                </div>
                                <?php $first = false; ?>
                            <?php endwhile; ?>
                        </div>
                        <?php if ($images->num_rows > 1): ?>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselHotel<?= $hotel['id'] ?>" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" style="background-color: rgba(0,0,0,0.5);"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselHotel<?= $hotel['id'] ?>" data-bs-slide="next">
                                <span class="carousel-control-next-icon" style="background-color: rgba(0,0,0,0.5);"></span>
                            </button>
                        <?php endif; ?>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title"><?= htmlspecialchars($hotel['name']) ?></h6>
                        <p class="card-text small"><?= htmlspecialchars(substr($hotel['description'], 0, 50)) ?>...</p>

                        <!-- <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="hotel_details.php?hotel_id=<?= $hotel['id'] ?>" class="btn btn-sm btn-primary mt-auto">View</a>
                        <?php else: ?>
                            <a href="../auth/login.php" class="btn btn-sm btn-outline-secondary mt-auto">Login</a>
                        <?php endif; ?> -->

                        <?php $isFull = $hotel['booked_rooms'] >= $hotel['total_rooms']; ?>
                            <?php if ($isFull): ?>
                                <button class="btn btn-sm btn-secondary mt-auto" disabled>Full</button>
                            <?php elseif (isset($_SESSION['user_id'])): ?>
                                <a href="hotel_details.php?hotel_id=<?= $hotel['id'] ?>" class="btn btn-sm btn-primary mt-auto">View</a>
                            <?php else: ?>
                                <a href="../auth/login.php" class="btn btn-sm btn-outline-secondary mt-auto">Login</a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
