<?php
session_start();
include('../includes/db.php');

if (!isset($_GET['hotel_id'])) {
    echo "No hotel selected!";
    exit;
}

$hotel_id = (int)$_GET['hotel_id'];
$hotel = $conn->query("SELECT * FROM hotels WHERE id = $hotel_id")->fetch_assoc();
if (!$hotel) {
    echo "Hotel not found!";
    exit;
}

$images = $conn->query("SELECT image FROM hotel_images WHERE hotel_id = $hotel_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .hotel-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        }
        .hotel-images img {
            object-fit: cover;
            height: 150px;
        }
    </style>
</head>
<body class="p-4">
    <div class="container">
        <a href="./hotels.php" class="btn btn-secondary mb-4">&larr; Back</a>

        <div class="hotel-card mx-auto d-flex justify-content-between" style="max-width: 900px;">
            <div>
                <h2 class="mb-3"><?= htmlspecialchars($hotel['name']) ?></h2>

                <div class="mb-3">
                    <strong>Description:</strong>
                    <p class="text-muted"><?= nl2br(htmlspecialchars($hotel['description'])) ?></p>
                </div>

                <div class="mb-3">
                    <strong>Price:</strong> 
                    <span class="text-success fw-bold fs-5"><?= number_format($hotel['price'], 2) ?> Ks</span>
                </div>

                <h4>Images</h4>
                <div class="d-flex flex-wrap gap-3 my-3">

                    <div id="hotelImagesCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $isFirst = true; // Flag for the first item to add active class
                            while ($img = $images->fetch_assoc()): 
                                $activeClass = $isFirst ? 'active' : ''; 
                                $isFirst = false;
                            ?>
                                <div class="carousel-item <?= $activeClass ?>" style="width: 250px;">
                                    <img src="../images/<?= htmlspecialchars($img['image']) ?>" 
                                        class="img-fluid rounded shadow-sm border" 
                                        alt="Hotel Image" style="height: 150px; object-fit: cover; width: 100%;">
                                </div>
                            <?php endwhile; ?>
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


                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="booking.php?hotel_id=<?= $hotel_id ?>" class="btn btn-primary">
                        Book Now
                    </a>
                <?php else: ?>
                    <p class="mt-3">Please <a href="../auth/login.php">login</a> to book this hotel.</p>
                <?php endif; ?>

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <a href="../admin/edit_hotel.php?id=<?= $hotel_id ?>" class="btn btn-warning ms-2">
                        Edit Hotel
                    </a>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <strong>Location:</strong> 
                <div class="map-responsive"><?= $hotel['location_embed'] ?></div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
