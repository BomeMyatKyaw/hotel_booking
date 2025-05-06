<?php
session_start();
include('../includes/db.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

// Fetch hotel information based on hotel_id from the URL parameter
if (isset($_GET['hotel_id'])) {
    $hotel_id = $_GET['hotel_id'];
    $sql = "SELECT * FROM hotels WHERE id = $hotel_id";
    $result = $conn->query($sql);
    $hotel = $result->fetch_assoc();
} else {
    header("Location: user/hotels.php"); // Redirect if no hotel_id is provided
    exit();
}

// Handle the booking form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    // Calculate the number of nights
    $check_in_date = new DateTime($check_in);
    $check_out_date = new DateTime($check_out);
    $interval = $check_in_date->diff($check_out_date);
    $num_nights = $interval->days;

    // Fetch the price per night for the selected hotel
    $price_per_night = $hotel['price'];

    // Calculate the total price
    $total_price = $price_per_night * $num_nights;

    // Insert the booking into the database
    $sql = "INSERT INTO bookings (user_id, hotel_id, check_in, check_out, total_price, created) 
            VALUES ('$user_id', '$hotel_id', '$check_in', '$check_out', '$total_price', NOW())";
    if ($conn->query($sql)) {
        echo "<script>alert('Booking Successful!'); window.location.href='./booking_list.php';</script>";
    } else {
        echo "<script>alert('Booking Failed!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Book Your Stay at <?= htmlspecialchars($hotel['name']) ?></h2>

    <!-- Booking Form -->
    <form method="POST" action="./booking.php?hotel_id=<?= $hotel['id'] ?>" class="mt-4">
        <div class="mb-3">
            <label for="check_in" class="form-label">Check-in Date</label>
            <input type="date" name="check_in" id="check_in" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="check_out" class="form-label">Check-out Date</label>
            <input type="date" name="check_out" id="check_out" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="total_price" class="form-label">Total Price</label>
            <input type="text" id="total_price" class="form-control" value="$0.00" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Book Now</button>
    </form>
</div>

<script>
// Calculate the total price when check-in or check-out dates change
document.getElementById('check_in').addEventListener('change', calculateTotalPrice);
document.getElementById('check_out').addEventListener('change', calculateTotalPrice);

function calculateTotalPrice() {
    const checkInDate = document.getElementById('check_in').value;
    const checkOutDate = document.getElementById('check_out').value;

    if (checkInDate && checkOutDate) {
        const checkIn = new Date(checkInDate);
        const checkOut = new Date(checkOutDate);

        const timeDifference = checkOut - checkIn;
        const numNights = timeDifference / (1000 * 3600 * 24); // Convert ms to days

        if (numNights > 0) {
            const pricePerNight = <?= $hotel['price']; ?>;
            const totalPrice = pricePerNight * numNights;
            document.getElementById('total_price').value = `$${totalPrice.toFixed(2)}`;
        } else {
            document.getElementById('total_price').value = '$0.00';
        }
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>
