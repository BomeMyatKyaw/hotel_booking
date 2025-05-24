<?php
    session_start();
    include('../includes/db.php');

    // Check admin access
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../index.php");
        exit;
    }

    // Validate input
    if (!isset($_GET['id']) || !is_numeric($_GET['id']) || !isset($_GET['hotel_id']) || !is_numeric($_GET['hotel_id'])) {
        echo "Invalid parameters.";
        exit;
    }

    $image_id = (int)$_GET['id'];
    $hotel_id = (int)$_GET['hotel_id'];

    // Fetch image
    $image = $conn->query("SELECT * FROM hotel_images WHERE id = $image_id AND hotel_id = $hotel_id")->fetch_assoc();

    if (!$image) {
        echo "Image not found.";
        exit;
    }

    // Delete image from server
    $image_path = "../images/" . $image['image'];
    if (file_exists($image_path)) {
        unlink($image_path);
    }

    // Delete from DB
    $conn->query("DELETE FROM hotel_images WHERE id = $image_id");

    // Redirect back to edit page
    header("Location: edit_hotel.php?id=$hotel_id");
    exit;
?>
