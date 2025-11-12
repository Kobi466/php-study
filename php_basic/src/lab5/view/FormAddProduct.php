<?php require_once(__DIR__ . '/templates/header.php'); ?>

    <h2>Thêm sản phẩm mới</h2>
    <form action="index.php?action=add" method="post" enctype="multipart/form-data">
        <label>Code:</label><br>
        <input type="text" name="code" required><br><br>
        <label>Tên sản phẩm:</label><br>
        <input type="text" name="name" required><br><br>
        <label>Giá:</label><br>
        <input type="number" step="0.01" name="price" required><br><br>
        <label>Ảnh sản phẩm:</label><br>
        <input type="file" name="image"><br><br>
        <input type="submit" value="Thêm sản phẩm">
    </form>

<?php require_once(__DIR__ . '/templates/footer.php'); ?>