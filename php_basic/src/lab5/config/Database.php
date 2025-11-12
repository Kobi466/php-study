<?php

class Database
{
    private $host = "db";
    private $user = "root";
    private $pass = "root";
    private $dbname = "lab5";
    private $pdo;
    private static $instance = null;

    private function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database Connection failed: " . $e->getMessage());
        }
    }

    // instance (Singleton)
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Trả về đối tượng kết nối PDO
    public function getConnection()
    {
        return $this->pdo;
    }
}
?>
