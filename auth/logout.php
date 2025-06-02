<?php
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Set headers to prevent caching (so back button won’t show secure pages)
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Redirect to homepage or login
header("Location: ../index.php");
exit;