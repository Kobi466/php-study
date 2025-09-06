# Mini Project User - Quản lý Người dùng

Đây là một dự án PHP nhỏ để quản lý người dùng, cho phép thực hiện các thao tác CRUD (Tạo, Đọc, Cập nhật, Xóa) cơ bản. Dự án được thiết kế để chạy trong môi trường Docker.

## Tính năng

*   Xem danh sách người dùng.
*   Thêm người dùng mới với tên, email, điện thoại và ảnh đại diện.
*   Cập nhật thông tin người dùng.
*   Xóa người dùng.

## Công nghệ sử dụng

*   **Backend:** PHP
*   **Cơ sở dữ liệu:** MySQL
*   **Môi trường:** Docker, Docker Compose

## Cấu trúc dự án

```
mini_project_user/
├── Dockerfile
├── docker-compose.yml
├── public/
│   ├── create.php
│   ├── delete.php
│   ├── index.php
│   ├── update.php
│   └── uploads/
└── src/
    ├── config/
    │   └── db.php
    ├── controller/
    │   └── UserController.php
    └── model/
        └── User.php
```

*   `public/`: Chứa các tệp giao diện người dùng và là điểm truy cập của ứng dụng.
*   `src/`: Chứa logic nghiệp vụ của ứng dụng, theo mô hình MVC.
    *   `config/`: Chứa tệp cấu hình kết nối cơ sở dữ liệu.
    *   `controller/`: Chứa các bộ điều khiển xử lý yêu cầu từ người dùng.
    *   `model/`: Chứa các lớp mô hình tương tác với cơ sở dữ liệu.
*   `Dockerfile`: Định nghĩa môi trường cho ứng dụng PHP.
*   `docker-compose.yml`: Dùng để triển khai ứng dụng và cơ sở dữ liệu MySQL.

## Bắt đầu

### Yêu cầu

*   [Docker](https://www.docker.com/get-started)
*   [Docker Compose](https://docs.docker.com/compose/install/)

### Cài đặt

1.  Clone dự án về máy của bạn.
2.  Mở terminal và điều hướng đến thư mục gốc của dự án.
3.  Chạy lệnh sau để khởi động ứng dụng:

    ```bash
    docker-compose up -d
    ```

### Sử dụng

Sau khi khởi động thành công, bạn có thể truy cập ứng dụng tại địa chỉ: `http://localhost:8080`

*   **Trang chủ (`index.php`):** Hiển thị danh sách tất cả người dùng.
*   **Tạo người dùng (`create.php`):** Biểu mẫu để thêm người dùng mới.
*   **Cập nhật người dùng (`update.php`):** Biểu mẫu để chỉnh sửa thông tin người dùng.
*   **Xóa người dùng (`delete.php`):** Xử lý logic xóa người dùng.

## Cơ sở dữ liệu

Khi ứng dụng khởi động lần đầu, một bảng có tên `users` sẽ được tự động tạo trong cơ sở dữ liệu `userdb` với cấu trúc như sau:

| Cột    | Kiểu          | Mô tả                  |
|--------|---------------|------------------------|
| `id`   | `INT`         | Khóa chính, tự tăng    |
| `name` | `VARCHAR(255)`| Tên người dùng         |
| `email`| `VARCHAR(255)`| Email người dùng       |
| `phone`| `VARCHAR(20)` | Số điện thoại          |
| `avatar`|`VARCHAR(255)`| Đường dẫn ảnh đại diện |
