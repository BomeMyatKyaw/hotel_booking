<?php
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: ../index.php');
        exit;
    }

    include('../includes/db.php');
    $pageTitle = "Manage Users";

    // Handle Status Update
    if (isset($_POST['update_status'])) {
        $id = intval($_POST['user_id']);
        $newStatus = $_POST['status'] === 'active' ? 'active' : 'inactive';
        $stmt = $conn->prepare("UPDATE users SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $newStatus, $id);
        $stmt->execute();
    }

    // Handle Role Update
    if (isset($_POST['update_role'])) {
        $id = intval($_POST['user_id']);
        $role = $_POST['role'] === 'admin' ? 'admin' : 'user';
        $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->bind_param("si", $role, $id);
        $stmt->execute();
    }

    // Name Filter
    $nameFilter = isset($_GET['name']) ? trim($_GET['name']) : '';
    $nameSQL = $nameFilter ? "WHERE username LIKE ?" : '';

    // Pagination
    $limit = 12;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    // Count total users with optional filter
    $countStmt = $nameFilter
        ? $conn->prepare("SELECT COUNT(*) AS total FROM users WHERE username LIKE ?")
        : $conn->prepare("SELECT COUNT(*) AS total FROM users");

    if ($nameFilter) {
        $like = '%' . $nameFilter . '%';
        $countStmt->bind_param("s", $like);
    }
    $countStmt->execute();
    $totalUsersResult = $countStmt->get_result();
    $totalUsersRow = $totalUsersResult->fetch_assoc();
    $totalUsersCount = $totalUsersRow['total'];
    $totalPages = ceil($totalUsersCount / $limit);

    // Fetch Users with Pagination and Filter
    $userStmt = $nameFilter
        ? $conn->prepare("SELECT * FROM users WHERE username LIKE ? ORDER BY id ASC LIMIT ? OFFSET ?")
        : $conn->prepare("SELECT * FROM users ORDER BY id ASC LIMIT ? OFFSET ?");

    if ($nameFilter) {
        $userStmt->bind_param("sii", $like, $limit, $offset);
    } else {
        $userStmt->bind_param("ii", $limit, $offset);
    }
    $userStmt->execute();
    $users = $userStmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="../assets/css/dashboardstyle.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px 16px;
            border: 1px solid #ccc;
        }
        th {
            background: #f9f9f9;
        }
        select, button, input[type="text"] {
            padding: 5px;
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0;
            right: 0; bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: #28a745;
        }
        input:checked + .slider:before {
            transform: translateX(26px);
        }
        .pagination {
            display: flex;
            justify-content: flex-end;
            padding: 20px 30px 0 0;
            margin-top: auto;
        }
        .pagination a {
            padding: 8px 12px;
            margin: 0 4px;
            text-decoration: none;
            border: 1px solid #ccc;
            color: #333;
            border-radius: 4px;
        }
        .pagination a.active {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
    </style>
</head>
<body>

<?php include('layouts/sidebar.php'); ?>
<div class="main">
    <?php include('layouts/header.php'); ?>

    <!-- Username Filter Form -->
    <div style="margin-bottom: 20px;">
        <form method="get">
            <div style="display: flex; max-width: 400px;">
                <input type="text" name="name" placeholder="Search by username..." value="<?= htmlspecialchars($nameFilter) ?>" 
                    style="flex: 1; padding: 8px 12px; border: 1px solid #ccc; border-radius: 4px 0 0 4px;">
                <button type="submit" 
                        style="padding: 8px 16px; background-color: #007bff; color: white; border: 1px solid #007bff; border-radius: 0 4px 4px 0; cursor: pointer;">
                    Search
                </button>
            </div>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $users->fetch_assoc()): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>

                    <!-- Role Dropdown -->
                    <td>
                        <form method="post">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <select name="role" onchange="this.form.submit()">
                                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                            </select>
                            <input type="hidden" name="update_role" value="1">
                        </form>
                    </td>

                    <!-- Toggle Switch for Status -->
                    <td>
                        <form method="post">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <input type="hidden" name="update_status" value="1">
                            <input type="hidden" name="status" value="<?= $user['status'] === 'active' ? 'inactive' : 'active' ?>">
                            <label class="switch">
                                <input type="checkbox" onchange="this.form.submit()" <?= $user['status'] === 'active' ? 'checked' : '' ?>>
                                <span class="slider"></span>
                            </label>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Pagination with Filter -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>&name=<?= urlencode($nameFilter) ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>

</div>

</body>
</html>
