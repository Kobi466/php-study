<?php
require_once __DIR__ . '/../src/controller/UserController.php';
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// --- Pagination Logic ---
if (isset($userModel)) {
    // 1. Define items per page
    $perPage = 5;

    // 2. Get total number of users
    $totalUsers = $userModel->getTotalUserCount();

    // 3. Calculate total pages
    $totalPages = ceil($totalUsers / $perPage);

    // 4. Get current page from URL, default to 1 and validate
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) {
        $page = 1;
    }
    if ($page > $totalPages && $totalPages > 0) {
        $page = $totalPages;
    }

    // 5. Get users for the current page
    $users = $userModel->getUsersPaginated($page, $perPage);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Users onboard System</title>
    <style>
        /* Some basic styling for pagination */
        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .pagination a {
            margin: 0 5px;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            color: #333;
            border-radius: 4px;
        }
        .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }
        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
</head>
<body>
<h1>Users onboard System</h1>
<h2>Welcome, <?= htmlspecialchars($_SESSION['user']['name']) ?> | <a href="logout.php">Logout</a></h2>
<a href="create.php">Add user</a>
<table border="1" cellpadding="8" style="width: 100%; margin-top: 15px;">
    <tr>
        <th>ID</th>
        <th>Avatar</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Actions</th>
    </tr>
    <?php if (!empty($users)): ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td>
                    <img src="<?= htmlspecialchars($user['avatar']) ?>"
                         alt="Avatar" width="50" height="50"
                         style="object-fit: cover; border-radius: 50%;">
                </td>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['phone']) ?></td>
                <td>
                    <a href="update.php?id=<?= $user['id'] ?>">Update</a>
                    <a href="delete.php?id=<?= $user['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6" style="text-align: center;">No users found.</td>
        </tr>
    <?php endif; ?>
</table>

<!-- --- Pagination View --- -->
<div class="pagination">
    <?php if ($totalPages > 1): ?>
        <?php // Previous page link ?>
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>">« Previous</a>
        <?php endif; ?>

        <?php // Page number links ?>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>

        <?php // Next page link ?>
        <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>">Next »</a>
        <?php endif; ?>
    <?php endif; ?>
</div>

</body>
</html>
