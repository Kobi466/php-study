<?php
global $userModel;
require_once __DIR__ . '/../src/controller/UserController.php';
$users = $userModel->getUsers();

?>
<!DOCTYPE html>
<html>
<head>
        <title>User List</title>
</head>
<body>
    <h1>User List</h1>
    <a href="create.php">Add user</a>
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= htmlspecialchars($user['id']) ?></td>
        <td><?= htmlspecialchars($user['name']) ?></td>
        <td><?= htmlspecialchars($user['email']) ?></td>
        <td><?= htmlspecialchars($user['phone']) ?></td>
        <td>
            <a href="update.php?id=<?= $user['id'] ?>">Update</a>
            <a href="delete.php?id=<?= $user['id'] ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
