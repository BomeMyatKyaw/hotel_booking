<?php
session_start();
include('../includes/db.php');

// Only allow access if admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid hotel ID.";
    exit;
}

$id = (int)$_GET['id'];

// Fetch hotel by ID
$hotel = $conn->query("SELECT * FROM hotels WHERE id = $id")->fetch_assoc();

// Check if hotel exists
if (!$hotel) {
    echo "Hotel not found.";
    exit;
}

// Fetch hotel images
$images = $conn->query("SELECT * FROM hotel_images WHERE hotel_id = $id");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $conn->query("UPDATE hotels SET name='$name', description='$description', price='$price' WHERE id=$id");

    // Upload new images if any
    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['name'] as $index => $imageName) {
            $tmpName = $_FILES['images']['tmp_name'][$index];
            $targetPath = "../images/" . basename($imageName);

            if (move_uploaded_file($tmpName, $targetPath)) {
                $conn->query("INSERT INTO hotel_images (hotel_id, image) VALUES ($id, '$imageName')");
            }
        }
    }

    header("Location: manage_hotels.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .position-absolute .btn-sm { font-size: 0.8rem; padding: 2px 6px; }
    </style>
</head>
<body class="p-4">
<div class="container">
    <h2>Edit Hotel</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-2">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($hotel['name']) ?>" required>
        </div>
        <div class="mb-2">
            <label>Description</label>
            <textarea name="description" class="form-control" required><?= htmlspecialchars($hotel['description']) ?></textarea>
        </div>
        <div class="mb-2">
            <label>Price</label>
            <input type="number" name="price" class="form-control" value="<?= $hotel['price'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Current Images</label><br>
            <?php while ($img = $images->fetch_assoc()): ?>
                <div class="d-inline-block position-relative me-2">
                    <img src="../images/<?= htmlspecialchars($img['image']) ?>" width="100" class="img-thumbnail">
                    <a href="delete_image.php?id=<?= $img['id'] ?>&hotel_id=<?= $id ?>"
                       onclick="return confirm('Delete this image?')"
                       class="btn btn-sm btn-danger position-absolute top-0 end-0">×</a>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="mb-2">
            <label>Upload New Images (optional)</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-primary">Update Hotel</button>
        <a href="manage_hotels.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
