<?php
session_start();
include('../includes/db.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Check for hotel_id and room_id
if (!isset($_GET['hotel_id']) || !isset($_GET['room_id'])) {
    header("Location: ./hotels.php");
    exit();
}

$hotel_id = (int)$_GET['hotel_id'];
$room_id = (int)$_GET['room_id'];

// Fetch hotel and room data
$hotel = $conn->query("SELECT * FROM hotels WHERE id = $hotel_id")->fetch_assoc();
$room = $conn->query("SELECT * FROM rooms WHERE id = $room_id AND hotel_id = $hotel_id")->fetch_assoc();

if (!$hotel || !$room) {
    echo "Hotel or Room not found.";
    exit();
}

// Handle the booking form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    if (strtotime($check_out) <= strtotime($check_in)) {
        echo "<script>alert('Check-out date must be after check-in date!');</script>";
    } else {
        $check_in_date = new DateTime($check_in);
        $check_out_date = new DateTime($check_out);
        $num_nights = $check_in_date->diff($check_out_date)->days;

        $price_per_night = $room['price'];
        $total_price = $price_per_night * $num_nights;

        // Step 1: Get total_rooms for the selected room
        $stmt = $conn->prepare("SELECT total_rooms FROM rooms WHERE id = ?");
        $stmt->bind_param("i", $room_id);
        $stmt->execute();
        $stmt->bind_result($total_rooms);
        $stmt->fetch();
        $stmt->close();

        // Step 2: Count how many times this room is booked (each booking = 1 room)
        $stmt = $conn->prepare("
            SELECT COUNT(*)
            FROM bookings
            WHERE room_id = ?
            AND status != 'cancelled'
            AND check_in < ?
            AND check_out > ?
        ");
        $stmt->bind_param("iss", $room_id, $check_out, $check_in);
        $stmt->execute();
        $stmt->bind_result($booked_rooms);
        $stmt->fetch();
        $stmt->close();

        // Step 3: Check if available rooms
        $available = $total_rooms - $booked_rooms;

        if ($available > 0) {
            // Proceed with booking
            $stmt = $conn->prepare("INSERT INTO bookings (user_id, hotel_id, room_id, check_in, check_out, total_price, created) VALUES (?, ?, ?, ?, ?, ?, NOW())");
            $stmt->bind_param("iiissd", $user_id, $hotel_id, $room_id, $check_in, $check_out, $total_price);

            if ($stmt->execute()) {
                echo "<script>alert('Booking Successful!'); window.location.href='./booking_list.php';</script>";
            } else {
                echo "<script>alert('Booking Failed!');</script>";
            }
        } else {
            echo "<script>alert('No available rooms for the selected dates!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Book <?= htmlspecialchars($room['name']) ?> at <?= htmlspecialchars($hotel['name']) ?></h2>

    <form method="POST" action="" class="mt-4">
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
            <input type="text" id="total_price" class="form-control" value="0 Ks" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Book Now</button>
    </form>
</div>

<script>
    const pricePerNight = <?= (int)$room['price'] ?>;

    function calculateTotalPrice() {
        const checkIn = new Date(document.getElementById('check_in').value);
        const checkOut = new Date(document.getElementById('check_out').value);
        const timeDiff = checkOut - checkIn;
        const nights = timeDiff / (1000 * 60 * 60 * 24);

        if (nights > 0) {
            const total = pricePerNight * nights;
            document.getElementById('total_price').value = `${total.toLocaleString(undefined, {minimumFractionDigits: 0})} Ks`;
        } else {
            document.getElementById('total_price').value = '0 Ks';
        }
    }

    document.getElementById('check_in').addEventListener('change', function () {
        const checkInDate = this.value;
        document.getElementById('check_out').min = checkInDate;
        calculateTotalPrice();
    });

    document.getElementById('check_out').addEventListener('change', calculateTotalPrice);

    // Disable today and past dates
    window.onload = function () {
        const today = new Date();
        today.setDate(today.getDate()); // if add +1 happen tomorrow
        const minDate = today.toISOString().split('T')[0];

        document.getElementById('check_in').min = minDate;
        document.getElementById('check_out').min = minDate;
    };
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
