<div class="topbar">
    <h1><?= $pageTitle ?? 'Dashboard' ?></h1>
    <div>User : <?= htmlspecialchars($_SESSION['username'] ?? 'Guest') ?></div>
</div>
