<?php
session_start();
include('includes/db.php');

// Fetch the hotel details based on the hotel ID
if (isset($_GET['hotel_id'])) {
    $hotel_id = $_GET['hotel_id'];
    $sql = "SELECT * FROM hotels WHERE id = $hotel_id";
    $result = $conn->query($sql);
    $hotel = $result->fetch_assoc();

    if (!$hotel) {
        echo "Hotel not found!";
        exit;
    }
} else {
    echo "No hotel selected!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Details</title>
    <link rel="stylesheet" href="assets/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        header {
            background-color: #333;
            padding: 20px;
            color: white;
            text-align: center;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
        }
        .hotel-details {
            margin: 20px auto;
            max-width: 900px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .hotel-details img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .hotel-details h2 {
            margin-bottom: 20px;
        }
        .hotel-details p {
            font-size: 1.1rem;
            margin-bottom: 15px;
        }
        .book-btn {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
        .book-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <header>
        <!-- Navigation Bar -->
        <nav>
            <h1>Hotel Details</h1>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="auth/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="auth/login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <div class="hotel-details">
        <h2><?php echo $hotel['name']; ?></h2>
        <img src="images/<?php echo $hotel['image']; ?>" alt="<?php echo $hotel['name']; ?>">
        <p><strong>Description:</strong> <?php echo $hotel['description']; ?></p>
        <p><strong>Price:</strong> $<?php echo $hotel['price']; ?></p>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="user/booking.php?hotel_id=<?php echo $hotel['id']; ?>" class="book-btn">Book Now</a>
        <?php else: ?>
            <button class="btn btn-secondary" disabled>Login to Book</button>
        <?php endif; ?>
    </div>
</body>
</html>
