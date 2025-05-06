<?php
session_start();
include('../includes/db.php');

// Redirect if not admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

// Search
$search = isset($_GET['search']) ? $_GET['search'] : '';
$searchQuery = $search ? "WHERE name LIKE '%$search%'" : '';

// Insert hotel and images
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Insert the hotel into the database
    $conn->query("INSERT INTO hotels (name, description, price) VALUES ('$name', '$description', '$price')");
    $hotel_id = $conn->insert_id; // Get the hotel ID of the inserted hotel

    // Loop through all uploaded images and save them to the database
    foreach ($_FILES['images']['name'] as $index => $imageName) {
        $tmpName = $_FILES['images']['tmp_name'][$index];
        $targetPath = "../images/" . basename($imageName);

        if (move_uploaded_file($tmpName, $targetPath)) {
            // Insert image into the hotel_images table
            $conn->query("INSERT INTO hotel_images (hotel_id, image) VALUES ('$hotel_id', '$imageName')");
        }
    }

    // Redirect after insert
    header("Location: manage_hotels.php");
    exit;
}

// Delete hotel
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];

    // Get images to delete from folder
    $result = $conn->query("SELECT image FROM hotel_images WHERE hotel_id = $id");
    while ($row = $result->fetch_assoc()) {
        $imagePath = "../images/" . $row['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete image file
        }
    }

    // Delete image records from database
    $conn->query("DELETE FROM hotel_images WHERE hotel_id = $id");

    // Delete hotel
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Hotels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        main {
            padding: 20px;
        }
        .hotel-card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .hotel-card img {
            max-height: 200px;
            object-fit: cover;
        }
        .search-form {
            margin-bottom: 20px;
        }
        .card-header {
            font-weight: bold;
            background-color: #f8f9fa;
        }
        .card-body {
            padding: 15px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Hotel Management</h2>
            <a href="../index.php" class="btn btn-secondary">Back</a>
        </div>

        <!-- Add Hotel Form -->
        <div class="card mb-4">
            <div class="card-header">Add New Hotel</div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Hotel Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" id="price" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="images" class="form-label">Images</label>
                        <input type="file" name="images[]" id="images" class="form-control" multiple required>
                    </div>
                    <button type="submit" name="create" class="btn btn-success">Add Hotel</button>
                </form>
            </div>
        </div>

        <!-- Search Form -->
        <div class="search-form">
            <form method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search hotel..." value="<?= htmlspecialchars($search) ?>">
                    <button class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>

        <!-- Hotel List Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Images</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($hotel = $hotels->fetch_assoc()): ?>
                        <tr>
                            <td><?= $hotel['id'] ?></td>
                            <td><?= htmlspecialchars($hotel['name']) ?></td>
                            <td><?= htmlspecialchars($hotel['description']) ?></td>
                            <td>$<?= number_format($hotel['price'], 2) ?></td>
                            <td>
                                <?php 
                                $images = $conn->query("SELECT image FROM hotel_images WHERE hotel_id = {$hotel['id']}");
                                while ($img = $images->fetch_assoc()):
                                ?>
                                    <img src="../images/<?= htmlspecialchars($img['image']) ?>" width="50" class="m-1 rounded">
                                <?php endwhile; ?>
                            </td>
                            <td>
                                <a href="edit_hotel.php?id=<?= $hotel['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="?delete=<?= $hotel['id'] ?>" onclick="return confirm('Are you sure you want to delete this hotel?')" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
