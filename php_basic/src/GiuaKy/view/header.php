<?php
$current_action = isset($_GET['action']) ? $_GET['action'] : 'index';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Giảng Viên</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">

<header>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="index.php">
                QL Giảng Viên
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php echo ($current_action == 'index') ? 'active' : ''; ?>">
                        <a class="nav-link" href="index.php">Danh sách</a>
                    </li>
                    <li class="nav-item <?php echo ($current_action == 'add') ? 'active' : ''; ?>">
                        <a class="nav-link" href="index.php?action=add">Thêm mới</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="container mt-5 flex-grow-1">
