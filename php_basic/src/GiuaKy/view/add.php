<?php
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$old_data = isset($_SESSION['old_data']) ? $_SESSION['old_data'] : [];
unset($_SESSION['error']);
unset($_SESSION['old_data']);

include 'header.php';
?>

<h2 class="page-title mb-4">Thêm Giảng viên mới</h2>

<?php if ($error): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <form action="index.php?action=add" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-image-preview">
                        <img id="imagePreview" src="assets/images/default.png" alt="Image Preview" class="image-preview"/>
                        <div class="custom-file mt-3">
                            <input type="file" name="HinhAnh" id="HinhAnh" class="custom-file-input" accept="image/*">
                            <label class="custom-file-label" for="HinhAnh">Chọn ảnh...</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-group">
                        <label for="MaGV">Mã Giảng viên</label>
                        <input type="text" name="MaGV" id="MaGV" class="form-control" value="<?php echo htmlspecialchars($old_data['MaGV'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="HoTen">Họ và Tên</label>
                        <input type="text" name="HoTen" id="HoTen" class="form-control" value="<?php echo htmlspecialchars($old_data['HoTen'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="TongSoLop">Tổng Số Lớp</label>
                        <input type="number" name="TongSoLop" id="TongSoLop" class="form-control" value="<?php echo htmlspecialchars($old_data['TongSoLop'] ?? ''); ?>" required>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            Lưu lại
                        </button>
                        <a href="index.php" class="btn btn-light ml-2">Quay lại</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
document.getElementById('HinhAnh').addEventListener('change', function(event) {
    const [file] = event.target.files;
    if (file) {
        const preview = document.getElementById('imagePreview');
        preview.src = URL.createObjectURL(file);
        
        const fileName = file.name;
        const nextSibling = event.target.nextElementSibling;
        nextSibling.innerText = fileName;
    }
});
</script>
