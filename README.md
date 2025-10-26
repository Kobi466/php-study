php-study (MVC)
Mô tả

Dự án học tập minh họa kiến trúc MVC bằng PHP.
Mục tiêu: cung cấp cấu trúc cơ bản để học cách tổ chức ứng dụng PHP (routing, controllers, models, views).
Yêu cầu

PHP 7.4+ (hoặc PHP 8+)
Composer
MySQL (nếu dùng database) hoặc SQLite
Web server (Apache/Nginx) hoặc dùng PHP built-in server
Cài đặt

Clone repo: git clone https://github.com/Kobi466/php-study.git
Chuyển sang nhánh MVC: git checkout MVC
Cài phụ thuộc: composer install
Tạo file cấu hình (ví dụ .env) từ mẫu: cp .env.example .env Cập nhật thông tin DB và cấu hình cần thiết.
Khởi động server (ví dụ dùng PHP built-in): php -S localhost:8000 -t public
Cấu trúc thư mục (ví dụ)

public/ — điểm vào ứng dụng (index.php, tài nguyên tĩnh)
app/ — mã nguồn ứng dụng (Controllers, Models, Helpers)
views/ — template/HTML
config/ — cấu hình ứng dụng
routes/ — định nghĩa route
vendor/ — phụ thuộc Composer
Sử dụng

Truy cập http://localhost:8000 sau khi khởi động server.
Các route được định nghĩa trong thư mục routes/.
Test

(Nếu có) Hướng dẫn chạy test, ví dụ: vendor/bin/phpunit
Đóng góp

Fork repo, tạo branch feature, gửi pull request. Vui lòng mô tả rõ thay đổi.
License

MIT
Liên hệ

Maintainer: @Kobi466
