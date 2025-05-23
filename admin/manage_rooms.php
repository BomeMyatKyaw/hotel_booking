<?php
session_start();
include('../includes/db.php');

// Redirect if not admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

$pageTitle = "Manage Rooms";

// Search
$search = isset($_GET['search']) ? $_GET['search'] : '';
$searchQuery = $search ? "WHERE r.room_type LIKE '%$search%' OR h.name LIKE '%$search%'" : '';

// Add room
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $hotel_id = $_POST['hotel_id'];
    $room_type = $_POST['room_type'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $max_guests = $_POST['max_guests'];
    $image_name = '';

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $image_name = basename($_FILES['image']['name']);
        $target = '../images/' . $image_name;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "Failed to upload image.";
            exit;
        }
    }

    $stmt = $conn->prepare("INSERT INTO rooms (hotel_id, room_type, description, price, max_guests, image_name) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issdis", $hotel_id, $room_type, $description, $price, $max_guests, $image_name);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_room.php");
    exit;
}

// Delete room
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];

    // Delete image file
    $res = $conn->query("SELECT image_name FROM rooms WHERE id = $id");
    $img = $res->fetch_assoc();
    if ($img && file_exists("../images/" . $img['image_name'])) {
        unlink("../images/" . $img['image_name']);
    }

    $conn->query("DELETE FROM rooms WHERE id = $id");
    header("Location: manage_room.php");
    exit;
}

// Get hotel list and rooms
$hotels = $conn->query("SELECT id, name FROM hotels");
$rooms = $conn->query("
    SELECT r.*, h.name AS hotel_name 
    FROM rooms r 
    JOIN hotels h ON r.hotel_id = h.id 
    $searchQuery
    ORDER BY r.id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Rooms</title>
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

        .room-img { 
            max-width: 100px; 
            max-height: 80px; 
            object-fit: cover; 
        }

        .table th, .table td { 
            vertical-align: middle; 
        }
    </style>
</head>
<body>

    <?php include('layouts/sidebar.php'); ?>
    <div class="main">
        <?php include('layouts/header.php'); ?>

        <div class="container-fluid mt-4">

            <!-- Add Room Form -->
            <div class="card mb-4 w-100">
                <div class="card-header">Add New Room</div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="hotel_id" class="form-label">Select Hotel</label>
                            <select name="hotel_id" id="hotel_id" class="form-select" required>
                                <option value="">-- Choose Hotel --</option>
                                <?php while ($hotel = $hotels->fetch_assoc()): ?>
                                    <option value="<?= $hotel['id'] ?>"><?= htmlspecialchars($hotel['name']) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="room_type" class="form-label">Room Type</label>
                            <input type="text" name="room_type" id="room_type" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" rows="3" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price ($)</label>
                            <input type="number" step="0.01" name="price" id="price" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="max_guests" class="form-label">Max Guests</label>
                            <input type="number" name="max_guests" id="max_guests" class="form-control" value="2" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Room Image</label>
                            <input type="file" name="image" id="image" class="form-control" required>
                        </div>
                        <button type="submit" name="create" class="btn btn-success">Add Room</button>
                    </form>
                </div>
            </div>

            <!-- Search -->
            <div class="mb-3">
                <form method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search room or hotel..." value="<?= htmlspecialchars($search) ?>">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>

            <!-- Room Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Room Type</th>
                            <th>Hotel</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Guests</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($room = $rooms->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($room['room_type']) ?></td>
                            <td><?= htmlspecialchars($room['hotel_name']) ?></td>
                            <td>
                                <?php if ($room['image_name']): ?>
                                    <img src="../images/<?= htmlspecialchars($room['image_name']) ?>" class="room-img rounded">
                                <?php else: ?>
                                    <span class="text-muted">No image</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($room['description']) ?></td>
                            <td>$<?= number_format($room['price'], 2) ?></td>
                            <td><?= (int)$room['max_guests'] ?></td>
                            <td>
                                <a href="edit_room.php?id=<?= $room['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="?delete=<?= $room['id'] ?>" onclick="return confirm('Delete this room?')" class="btn btn-sm btn-danger">Delete</a>
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
