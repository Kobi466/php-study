<?php require_once(__DIR__ . '/templates/header.php'); ?>

    <h2>Danh sách sản phẩm</h2>
    <table>
        <thead>
        <tr>
            <th>Ảnh</th><th>Code</th><th>Tên sản phẩm</th><th>Giá</th><th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td>
                    <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['productName']); ?>">
                </td>
                <td><?php echo htmlspecialchars($product['productCode']); ?></td>
                <td><?php echo htmlspecialchars($product['productName']); ?></td>
                <td>$<?php echo htmlspecialchars(number_format($product['listPrice'], 2)); ?></td>
                <td>
                    <a href="index.php?action=show_edit_form&id=<?php echo $product['productID']; ?>">Sửa</a>
                    &nbsp;|&nbsp;
                    <a href="index.php?action=delete&id=<?php echo $product['productID']; ?>"
                       onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php require_once(__DIR__ . '/templates/footer.php'); ?>