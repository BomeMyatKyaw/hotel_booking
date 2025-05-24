<div class="sidebar">
    <a href="./../index.php" target="_self">Home</a>
    <a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a>
    <a href="manage_users.php" class="<?= basename($_SERVER['PHP_SELF']) == 'manage_users.php' ? 'active' : '' ?>">Users</a>
    <a href="manage_hotels.php" class="<?= basename($_SERVER['PHP_SELF']) == 'manage_hotels.php' ? 'active' : '' ?>">Hotels</a>
    <a href="manage_rooms.php" class="<?= basename($_SERVER['PHP_SELF']) == 'manage_rooms.php' ? 'active' : '' ?>">Rooms</a>
    <a href="bookinglists.php" class="<?= basename($_SERVER['PHP_SELF']) == 'bookinglists.php' ? 'active' : '' ?>">Lists</a>
    <a href="../auth/logout.php">Logout</a>
</div>