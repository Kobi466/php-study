<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once 'config/Database.php';
include_once 'model/GiangVien.php';

class GiangVienController {

    private function uploadImage($file_input, &$error_message) {
        if (!isset($file_input) || $file_input['error'] !== UPLOAD_ERR_OK) {
            if ($file_input['error'] === UPLOAD_ERR_NO_FILE) {
                return null;
            }
            $error_message = "Có lỗi xảy ra trong quá trình tải file.";
            return false;
        }

        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . uniqid() . '-' . basename($file_input["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($imageFileType, $allowed_types)) {
            $error_message = "Chỉ cho phép tải lên file ảnh định dạng JPG, JPEG, PNG, GIF.";
            return false;
        }

        $check = getimagesize($file_input["tmp_name"]);
        if ($check === false) {
            $error_message = "File bạn chọn không phải là file ảnh.";
            return false;
        }

        if ($file_input["size"] > 2000000) {
            $error_message = "Kích thước file quá lớn. Vui lòng chọn file nhỏ hơn 2MB.";
            return false;
        }

        if (move_uploaded_file($file_input["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            $error_message = "Không thể di chuyển file đã tải lên.";
            return false;
        }
    }

    public function index() {
        $database = new Database();
        $db = $database->getConnection();
        $giangvien = new GiangVien($db);
        $stmt = $giangvien->read();
        include 'view/list.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $upload_error = '';
            $hinhAnhPath = $this->uploadImage($_FILES['HinhAnh'], $upload_error);

            if ($upload_error) {
                $_SESSION['error'] = $upload_error;
                $_SESSION['old_data'] = $_POST;
                header("Location: index.php?action=add");
                exit();
            }

            $database = new Database();
            $db = $database->getConnection();
            $giangvien = new GiangVien($db);

            $giangvien->MaGV = $_POST['MaGV'];
            $giangvien->HoTen = $_POST['HoTen'];
            $giangvien->TongSoLop = $_POST['TongSoLop'];
            $giangvien->HinhAnh = $hinhAnhPath;

            try {
                if ($giangvien->create()) {
                    header("Location: index.php");
                    exit();
                }
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    $_SESSION['error'] = "Mã giảng viên '{$giangvien->MaGV}' đã tồn tại.";
                    $_SESSION['old_data'] = $_POST;
                    header("Location: index.php?action=add");
                    exit();
                } else {
                    die("Lỗi không xác định: " . $e->getMessage());
                }
            }
        }
        include 'view/add.php';
    }

    public function edit() {
        $database = new Database();
        $db = $database->getConnection();
        $giangvien = new GiangVien($db);
        $giangvien->MaGV = isset($_GET['id']) ? $_GET['id'] : die();
        $giangvien->readOne();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $upload_error = '';
            $hinhAnhPath = $this->uploadImage($_FILES['HinhAnh'], $upload_error);

            if ($upload_error) {
                $_SESSION['error'] = $upload_error;
                header("Location: index.php?action=edit&id=" . $giangvien->MaGV);
                exit();
            }

            $giangvien->HoTen = $_POST['HoTen'];
            $giangvien->TongSoLop = $_POST['TongSoLop'];

            if ($hinhAnhPath) {
                if (!empty($giangvien->HinhAnh) && file_exists($giangvien->HinhAnh)) {
                    unlink($giangvien->HinhAnh);
                }
                $giangvien->HinhAnh = $hinhAnhPath;
            }

            if ($giangvien->update()) {
                header("Location: index.php");
                exit();
            }
        }
        include 'view/edit.php';
    }

    public function delete() {
        $database = new Database();
        $db = $database->getConnection();
        $giangvien = new GiangVien($db);
        $giangvien->MaGV = isset($_GET['id']) ? $_GET['id'] : die();
        $giangvien->readOne();

        if ($giangvien->delete()) {
            if (!empty($giangvien->HinhAnh) && file_exists($giangvien->HinhAnh)) {
                unlink($giangvien->HinhAnh);
            }
            header("Location: index.php");
            exit();
        }
    }
}
