<div class="sidebar">
    <h2>MyAdmin</h2>
    <a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a>
    <a href="../manage_users.php" class="<?= basename($_SERVER['PHP_SELF']) == 'manage_users.php' ? 'active' : '' ?>">Users</a>
    <a href="manage_hotels.php" class="<?= basename($_SERVER['PHP_SELF']) == 'manage_hotels.php' ? 'active' : '' ?>">Hotels</a>
    <a href="manage_rooms.php" class="<?= basename($_SERVER['PHP_SELF']) == 'manage_rooms.php' ? 'active' : '' ?>">Rooms</a>
    <a href="../auth/logout.php">Logout</a>
</div>