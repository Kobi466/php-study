<?php require_once(__DIR__ . '/templates/header.php'); ?>

    <h2>Sửa thông tin sản phẩm</h2>
    <form action="index.php?action=update" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['productID']); ?>">
        <input type="hidden" name="old_image" value="<?php echo htmlspecialchars($product['image']); ?>">

        <label>Code:</label><br>
        <input type="text" name="code" value="<?php echo htmlspecialchars($product['productCode']); ?>" required><br><br>
        <label>Tên sản phẩm:</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($product['productName']); ?>" required><br><br>
        <label>Giá:</label><br>
        <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($product['listPrice']); ?>" required><br><br>
        <label>Ảnh hiện tại:</label><br>
        <img src="images/<?php echo htmlspecialchars($product['image']); ?>"><br><br>
        <label>Tải lên ảnh mới (để trống nếu không muốn thay đổi):</label><br>
        <input type="file" name="image"><br><br>
        <input type="submit" value="Cập nhật">
    </form>

<?php require_once(__DIR__ . '/templates/footer.php'); ?>