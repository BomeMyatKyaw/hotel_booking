<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch current user info
$user = $conn->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
if (!$user) {
    echo "User not found.";
    exit;
}

// Update account
if (isset($_POST['update'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);

    $conn->query("UPDATE users SET username = '$username', email = '$email' WHERE id = $user_id");
    $success = "Account updated successfully.";
}

// Disable account (soft deactivate)
if (isset($_POST['disable'])) {
    $conn->query("UPDATE users SET status = 'disabled' WHERE id = $user_id");
    session_destroy();
    header("Location: ../auth/login.php");
    exit;
}

// Delete account (permanent)
if (isset($_POST['delete'])) {
    $conn->query("DELETE FROM users WHERE id = $user_id");
    session_destroy();
    header("Location: ../auth/register.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Edit Account</h2>

    <?php if (!empty($success)) echo "<div class='alert alert-success'>$success</div>"; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update</button>
    </form>

    <hr>

    <div class="d-flex justify-content-start align-items-center">
        <form method="POST" onsubmit="return confirm('Are you sure you want to disable your account? You can reactivate later by contacting admin.')">
            <button type="submit" name="disable" class="btn btn-warning mt-2">Disable Account</button>
        </form>

        <form method="POST" onsubmit="return confirm('Are you sure you want to permanently delete your account? This cannot be undone.')">
            <button type="submit" name="delete" class="btn btn-danger mt-2 mx-3">Delete Account</button>
        </form>

        <a href="../index.php" class="btn btn-secondary mt-2">Back to Home</a>
    </div>
</div>
</body>
</html>
