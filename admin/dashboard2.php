<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard - Page Switching</title>
  <style>
    /* Sidebar styles (same as before) */
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      min-height: 100vh;
      background-color: #f1f5f9;
    }
    .sidebar {
      width: 250px;
      background-color: #1e293b;
      color: #cbd5e1;
      display: flex;
      flex-direction: column;
      padding-top: 20px;
      position: fixed;
      height: 100%;
    }
    .sidebar h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #fff;
    }
    .sidebar a {
      padding: 15px 30px;
      text-decoration: none;
      color: #cbd5e1;
      transition: 0.3s;
      cursor: pointer;
    }
    .sidebar a:hover,
    .sidebar a.active {
      background-color: #3b82f6;
      color: white;
    }

    .main {
      margin-left: 250px;
      padding: 20px;
      flex: 1;
      width: 100%;
    }

    /* Sections */
    .page {
      display: none;
    }
    .page.active {
      display: block;
    }
  </style>
</head>
<body>

  <div class="sidebar">
    <h2>MyAdmin</h2>
    <a class="active" data-page="dashboard">Dashboard</a>
    <a data-page="users">Users</a>
    <a data-page="analytics">Analytics</a>
    <a data-page="settings">Settings</a>
    <a data-page="logout">Logout</a>
  </div>

  <div class="main">
    <div id="dashboard" class="page active">
      <h1>Dashboard Overview</h1>
      <p>Welcome to the dashboard!</p>
    </div>

    <div id="users" class="page">
      <h1>Users Page</h1>
      <p>Manage your users here.</p>
    </div>

    <div id="analytics" class="page">
      <h1>Analytics Page</h1>
      <p>View your analytics here.</p>
    </div>

    <div id="settings" class="page">
      <h1>Settings Page</h1>
      <p>Adjust your settings here.</p>
    </div>

    <div id="logout" class="page">
      <h1>Logout</h1>
      <p>You will be logged out.</p>
    </div>
  </div>

  <script>
    const links = document.querySelectorAll('.sidebar a');
    const pages = document.querySelectorAll('.page');

    links.forEach(link => {
      link.addEventListener('click', () => {
        // Remove active class on links
        links.forEach(l => l.classList.remove('active'));
        link.classList.add('active');

        // Hide all pages
        pages.forEach(page => page.classList.remove('active'));

        // Show selected page
        const pageId = link.getAttribute('data-page');
        document.getElementById(pageId).classList.add('active');
      });
    });
  </script>

</body>
</html>

