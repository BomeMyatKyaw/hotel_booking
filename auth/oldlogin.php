<?php
session_start();
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user by username
    $sql = "SELECT * FROM users WHERE username = '$username' AND status = 'active'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Check password
        if (password_verify($password, $user['password'])) {
            // ✅ Set session variables after successful login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role']; // user or admin

            // Redirect to index or dashboard
            header("Location: ../index.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>