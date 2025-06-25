<?php
session_start();
include('../includes/db.php');

$pageTitle = "Booking Lists";

// Handle filters
$nameFilter = isset($_GET['name']) ? trim($_GET['name']) : '';
$dateFilter = isset($_GET['date']) ? trim($_GET['date']) : '';
$checkInFilter = isset($_GET['check_in']) ? trim($_GET['check_in']) : '';
$checkOutFilter = isset($_GET['check_out']) ? trim($_GET['check_out']) : '';


$where = [];
if ($nameFilter !== '') {
    $safeName = $conn->real_escape_string($nameFilter);
    $where[] = "users.username LIKE '%$safeName%'";
}
if ($dateFilter !== '') {
    $safeDate = $conn->real_escape_string($dateFilter);
    $where[] = "DATE(bookings.created) = '$safeDate'";
}
if ($checkInFilter !== '') {
    $safeCheckIn = $conn->real_escape_string($checkInFilter);
    $where[] = "bookings.check_in >= '$safeCheckIn'";
}

if ($checkOutFilter !== '') {
    $safeCheckOut = $conn->real_escape_string($checkOutFilter);
    $where[] = "bookings.check_out <= '$safeCheckOut'";
}



$whereSql = '';
if (!empty($where)) {
    $whereSql = 'WHERE ' . implode(' AND ', $where);
}

// Fetch bookings with filters
$sql = "SELECT bookings.*, hotels.name AS hotel_name, rooms.name AS room_name, users.username
        FROM bookings 
        JOIN hotels ON bookings.hotel_id = hotels.id 
        JOIN rooms ON bookings.room_id = rooms.id 
        JOIN users ON bookings.user_id = users.id 
        $whereSql
        ORDER BY bookings.created ASC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/dashboardstyle.css" />
    <style>
        body { 
            background-color: #f8f9fa; 
        }

        .main { 
            margin-left: 250px; 
        }

        .table th, .table td { 
            vertical-align: middle; 
        }
        
        .btn-info, .btn-danger { 
            font-size: 0.9rem; 
            padding: 0.4rem 1rem; 
        }

        .modal-content { 
            border-radius: 10px; 
        }

        .modal-header { 
            background-color: #343a40; 
            color: #fff; 
        }
        
        .modal-footer button, .back-btn { 
            border-radius: 50px; 
        }
    </style>
</head>
<body>

<?php include('layouts/sidebar.php'); ?>
<div class="main">
    <?php include('layouts/header.php'); ?>

        <div class="container-fluid mt-4">

            <!-- Filters -->
            <div class="mb-3">
                <form method="get" class="row g-2">
                    <div class="col-md-2">
                        <input type="text" name="name" class="form-control" placeholder="Search by username..." 
                            value="<?= htmlspecialchars($nameFilter) ?>">
                    </div>
                    <div class="col-md-4 d-flex align-items-center">
                        <input type="date" name="check_in" class="form-control me-1" 
                            value="<?= htmlspecialchars($_GET['check_in'] ?? '') ?>">
                        
                        <span class="mx-1">~</span>
                        
                        <input type="date" name="check_out" class="form-control ms-1" 
                            value="<?= htmlspecialchars($_GET['check_out'] ?? '') ?>">
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                    </div>
                    <div class="col-md-1">
                        <a href="./bookinglists.php" class="btn btn-primary" role="button" title="Refresh">
                            <i class="fas fa-redo-alt"></i>
                        </a>
                    </div>
                </form>
            </div>

            <?php if ($result && $result->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Hotel</th>
                                <th>Room</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($booking = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($booking['username']); ?></td>
                                <td><?= htmlspecialchars($booking['hotel_name']); ?></td>
                                <td><?= htmlspecialchars($booking['room_name']); ?></td>
                                <td><?= htmlspecialchars($booking['check_in']); ?></td>
                                <td><?= htmlspecialchars($booking['check_out']); ?></td>
                                <td><?= number_format($booking['total_price'], 0); ?>Ks</td>
                                <td>
                                    <?php
                                    $status = $booking['status'];
                                    if ($status === 'paid') {
                                        echo '<span class="badge bg-success">Paid</span>';
                                    } elseif ($status === 'cancelled') {
                                        echo '<span class="badge bg-danger">Cancelled</span>';
                                    } else {
                                        echo '<span class="badge bg-warning text-dark">Unpaid</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#bookingModal<?= $booking['id']; ?>">View</button>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="bookingModal<?= $booking['id']; ?>" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Booking Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>User:</strong> <?= htmlspecialchars($booking['username']); ?></p>
                                            <p><strong>Hotel:</strong> <?= htmlspecialchars($booking['hotel_name']); ?></p>
                                            <p><strong>Room:</strong> <?= htmlspecialchars($booking['room_name']); ?></p>
                                            <p><strong>Check-in:</strong> <?= htmlspecialchars($booking['check_in']); ?></p>
                                            <p><strong>Check-out:</strong> <?= htmlspecialchars($booking['check_out']); ?></p>
                                            <p><strong>Total Price:</strong> <?= number_format($booking['total_price'], 0); ?> Ks</p>
                                            <p><strong>Status:</strong>
                                                <?php
                                                    if ($status === 'paid') {
                                                        echo '<span class="text-success">Paid</span>';
                                                    } elseif ($status === 'cancelled') {
                                                        echo '<span class="text-danger">Cancelled</span>';
                                                    } else {
                                                        echo '<span class="text-warning">Unpaid</span>';
                                                    }
                                                ?>
                                            </p>
                                            <p><strong>Created On:</strong> <?= htmlspecialchars($booking['created']); ?></p>
                                            <p><strong>Updated On:</strong> <?= htmlspecialchars($booking['updated']); ?></p>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">No bookings found.</div>
        <?php endif; ?>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>
