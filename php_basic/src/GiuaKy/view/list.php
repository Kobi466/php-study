<?php include 'header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="page-title mb-0">Danh sách Giảng viên</h2>
    <a href="index.php?action=add" class="btn btn-primary">
        Thêm Giảng viên
    </a>
</div>

<div class="table-responsive">
    <table class="table text-center responsive-card-table">
        <thead>
            <tr>
                <th>Mã GV</th>
                <th>Họ Tên</th>
                <th>Hình Ảnh</th>
                <th>Tổng Số Lớp</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    echo "<tr>";
                    echo "<td data-label='Mã GV'><strong>" . htmlspecialchars($MaGV) . "</strong></td>";
                    echo "<td data-label='Họ Tên'>" . htmlspecialchars($HoTen) . "</td>";
                    echo "<td data-label='Hình Ảnh'>";
                    if (!empty($HinhAnh) && file_exists($HinhAnh)) {
                        echo "<img src='" . htmlspecialchars($HinhAnh) . "' alt='Hình ảnh' class='avatar'>";
                    } else {
                        echo "<img src='assets/images/default.png' alt='Default Avatar' class='avatar'>";
                    }
                    echo "</td>";
                    echo "<td data-label='Tổng Số Lớp'>" . htmlspecialchars($TongSoLop) . "</td>";
                    echo "<td data-label='Hành động'>";
                    echo "<a href='index.php?action=edit&id=" . htmlspecialchars($MaGV) . "' class='btn btn-secondary btn-sm mr-2' title='Sửa'>Sửa</a>";
                    echo "<button type='button' class='btn btn-danger btn-sm delete-btn' data-toggle='modal' data-target='#deleteModal' data-id='" . htmlspecialchars($MaGV) . "' title='Xóa'>Xóa</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center py-5'>Chưa có giảng viên nào.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Xác nhận Xóa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Bạn có chắc chắn muốn xóa giảng viên này? Hành động này không thể hoàn tác.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Hủy</button>
        <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Xóa</a>
      </div>
    </div>
  </div>
</div>


<?php include 'footer.php'; ?>

<script>
$(document).ready(function() {
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var gvId = button.data('id');
        var modal = $(this);
        modal.find('#confirmDeleteBtn').attr('href', 'index.php?action=delete&id=' + gvId);
    });
});
</script>
