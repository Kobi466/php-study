<?php
class Database {
    private $host = "db";
    private $db_name = "QLHocPhan";
    private $username = "root";
    private $password = "root";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $temp_conn = new PDO("mysql:host=" . $this->host, $this->username, $this->password);
            $temp_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $temp_conn->exec("CREATE DATABASE IF NOT EXISTS " . $this->db_name);
            $temp_conn = null;

            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $table_query = "CREATE TABLE IF NOT EXISTS GiangVien (
                MaGV VARCHAR(10) PRIMARY KEY,
                HoTen VARCHAR(255) NOT NULL,
                HinhAnh VARCHAR(255),
                TongSoLop INT NOT NULL
            )";
            $this->conn->exec($table_query);

        } catch(PDOException $exception) {
            die("Lỗi kết nối hoặc khởi tạo DB: " . $exception->getMessage());
        }

        return $this->conn;
    }
}
