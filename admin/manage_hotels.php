<?php
    session_start();
    include('../includes/db.php');

    // Redirect if not admin
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../index.php");
        exit;
    }

    $pageTitle = "Manage Hotels";

    // Search
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $searchQuery = $search ? "WHERE name LIKE '%$search%'" : '';

    // Insert hotel and images
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $location_embed = $conn->real_escape_string($_POST['location_embed']);

        // Insert the hotel
        $conn->query("INSERT INTO hotels (name, description, price, location_embed) VALUES ('$name', '$description', '$price', '$location_embed')");
        $hotel_id = $conn->insert_id;

        // Upload images
        foreach ($_FILES['images']['name'] as $index => $imageName) {
            $tmpName = $_FILES['images']['tmp_name'][$index];
            $error = $_FILES['images']['error'][$index];
        
            if ($error !== UPLOAD_ERR_OK) {
                echo "Error uploading $imageName: $error<br>";
                continue;
            }
        
            $targetPath = "../images/" . basename($imageName);
            if (move_uploaded_file($tmpName, $targetPath)) {
                $conn->query("INSERT INTO hotel_images (hotel_id, image) VALUES ('$hotel_id', '$imageName')");
            } else {
                echo "Failed to move file: $imageName<br>";
            }
        }    

        header("Location: manage_hotels.php");
        exit;
    }

    // Delete hotel
    if (isset($_GET['delete'])) {
        $id = (int)$_GET['delete'];

        $result = $conn->query("SELECT image FROM hotel_images WHERE hotel_id = $id");
        while ($row = $result->fetch_assoc()) {
            $imagePath = "../images/" . $row['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $conn->query("DELETE FROM hotel_images WHERE hotel_id = $id");
        $conn->query("DELETE FROM hotels WHERE id = $id");

        header("Location: manage_hotels.php");
        exit;
    }

    $hotels = $conn->query("SELECT * FROM hotels $searchQuery ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/dashboardstyle.css" />
    
    <style>
        body { font-family: Arial, sans-serif; }

        body {
            margin: 0;
            padding: 0;
        }

        .main {
            margin-left: 250px; /* Matches sidebar width */
        }

        .map-responsive {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            max-width: 250px;
        }

        .map-responsive iframe {
            position: absolute;
            top: 0; 
            left: 0;
            width: 100%; 
            height: 100%;
            border: 0;
        }

        .hotel-card img {
            max-height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

    <?php include('layouts/sidebar.php'); ?>
    <div class="main">
        <?php include('layouts/header.php'); ?>

        <div class="container-fluid mt-4">

            <!-- Add Hotel Form -->
            <div class="card mb-4 w-100">
                <div class="card-header">Add New Hotel</div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">

                        <div class="d-flex gap-2 mb-2">
                            <div class="col-md-6">
                                <div>
                                    <label for="name" class="form-label">Hotel Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                                <div>
                                    <label for="price" class="form-label">Price (Ks)</label>
                                    <input type="number" name="price" id="price" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label for="location_embed" class="form-label">Google Maps Embed Code</label>
                            <textarea name="location_embed" id="location_embed" class="form-control" placeholder="Paste Google Maps iframe code here..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label">Images</label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple required>
                        </div>

                        <button type="submit" name="create" class="btn btn-success">Add Hotel</button>

                    </form>
                </div>
            </div>

            <!-- Search -->
            <div class="mb-3">
                <form method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search hotel..." value="<?= htmlspecialchars($search) ?>">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>

            <!-- Hotels Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price (Ks)</th>
                        <th>Images</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($hotel = $hotels->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($hotel['name']) ?></td>
                            <td><?= htmlspecialchars($hotel['description']) ?></td>
                            <td><?= number_format($hotel['price'], 2) ?>Ks</td>
                            <td>
                                <?php 
                                $images = $conn->query("SELECT image FROM hotel_images WHERE hotel_id = {$hotel['id']}");
                                while ($img = $images->fetch_assoc()):
                                ?>
                                    <img src="../images/<?= htmlspecialchars($img['image']) ?>" width="50" class="m-1 rounded">
                                <?php endwhile; ?>
                            </td>
                            <td>
                                <?php if (!empty($hotel['location_embed'])): ?>
                                    <div class="map-responsive"><?= $hotel['location_embed'] ?></div>
                                <?php else: ?>
                                    <span class="text-muted">No map</span>
                                <?php endif; ?>
                            </td>
                            <td class="d-flex justify-content-center">
                                <a href="edit_hotel.php?id=<?= $hotel['id'] ?>" class="btn btn-sm btn-warning mx-2">Edit</a>
                                <a href="?delete=<?= $hotel['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
