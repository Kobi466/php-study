<?php
// Lấy lỗi từ session (nếu có)
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
// Xóa session sau khi đã lấy để không hiển thị lại ở lần sau
unset($_SESSION['error']);

include 'header.php';
?>

<h2 class="page-title mb-4">Chỉnh sửa thông tin Giảng viên</h2>

<?php if ($error): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <form action="index.php?action=edit&id=<?php echo $giangvien->MaGV; ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-image-preview">
                        <?php 
                        $currentImage = 'assets/images/default.png';
                        if (!empty($giangvien->HinhAnh) && file_exists($giangvien->HinhAnh)) {
                            $currentImage = htmlspecialchars($giangvien->HinhAnh);
                        }
                        ?>
                        <img id="imagePreview" src="<?php echo $currentImage; ?>" alt="Image Preview" class="image-preview"/>
                        <div class="custom-file mt-3">
                            <input type="file" name="HinhAnh" id="HinhAnh" class="custom-file-input" accept="image/*">
                            <label class="custom-file-label" for="HinhAnh">Đổi ảnh...</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-group">
                        <label for="HoTen">Họ và Tên</label>
                        <input type="text" name="HoTen" id="HoTen" class="form-control" value="<?php echo htmlspecialchars($giangvien->HoTen); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="TongSoLop">Tổng Số Lớp</label>
                        <input type="number" name="TongSoLop" id="TongSoLop" class="form-control" value="<?php echo htmlspecialchars($giangvien->TongSoLop); ?>" required>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            Cập nhật
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
