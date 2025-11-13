<?php
class GiangVien {
    private $conn;
    private $table_name = "GiangVien";

    public $MaGV;
    public $HoTen;
    public $HinhAnh;
    public $TongSoLop;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function create() {
        $query = "INSERT INTO " . $this->table_name . " SET MaGV=:MaGV, HoTen=:HoTen, HinhAnh=:HinhAnh, TongSoLop=:TongSoLop";
        $stmt = $this->conn->prepare($query);

        $this->MaGV = htmlspecialchars(strip_tags($this->MaGV ?? ''));
        $this->HoTen = htmlspecialchars(strip_tags($this->HoTen ?? ''));
        $this->HinhAnh = htmlspecialchars(strip_tags($this->HinhAnh ?? ''));
        $this->TongSoLop = htmlspecialchars(strip_tags($this->TongSoLop ?? ''));

        $stmt->bindParam(":MaGV", $this->MaGV);
        $stmt->bindParam(":HoTen", $this->HoTen);
        $stmt->bindParam(":HinhAnh", $this->HinhAnh);
        $stmt->bindParam(":TongSoLop", $this->TongSoLop);

        $stmt->execute();
        return true;
    }

    function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaGV = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaGV);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->HoTen = $row['HoTen'];
            $this->HinhAnh = $row['HinhAnh'];
            $this->TongSoLop = $row['TongSoLop'];
        }
    }

    function update() {
        $query = "UPDATE " . $this->table_name . " SET HoTen = :HoTen, HinhAnh = :HinhAnh, TongSoLop = :TongSoLop WHERE MaGV = :MaGV";
        $stmt = $this->conn->prepare($query);

        $this->HoTen = htmlspecialchars(strip_tags($this->HoTen ?? ''));
        $this->HinhAnh = htmlspecialchars(strip_tags($this->HinhAnh ?? ''));
        $this->TongSoLop = htmlspecialchars(strip_tags($this->TongSoLop ?? ''));
        $this->MaGV = htmlspecialchars(strip_tags($this->MaGV ?? ''));

        $stmt->bindParam(':HoTen', $this->HoTen);
        $stmt->bindParam(':HinhAnh', $this->HinhAnh);
        $stmt->bindParam(':TongSoLop', $this->TongSoLop);
        $stmt->bindParam(':MaGV', $this->MaGV);

        $stmt->execute();
        return true;
    }

    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaGV = ?";
        $stmt = $this->conn->prepare($query);

        $this->MaGV = htmlspecialchars(strip_tags($this->MaGV ?? ''));
        $stmt->bindParam(1, $this->MaGV);

        $stmt->execute();
        return true;
    }
}
