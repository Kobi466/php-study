<?php

class User
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getUsers(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM users ORDER BY id DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Lấy danh sách người dùng cho một trang cụ thể.
     *
     * @param int $page Số trang hiện tại.
     * @param int $perPage Số lượng người dùng trên mỗi trang.
     * @return array Danh sách người dùng.
     */
    public function getUsersPaginated(int $page = 1, int $perPage = 5): array
    {
        $offset = ($page - 1) * $perPage;
        $stmt = $this->pdo->prepare('SELECT * FROM users ORDER BY id DESC LIMIT :limit OFFSET :offset');
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Lấy tổng số người dùng trong cơ sở dữ liệu.
     *
     * @return int Tổng số người dùng.
     */
    public function getTotalUserCount(): int
    {
        $stmt = $this->pdo->query('SELECT COUNT(*) FROM users');
        return (int) $stmt->fetchColumn();
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser(string $name, string $email, string $password, string $phone, string $avatarPath): void
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare('INSERT INTO users (name, email, password, phone, avatar) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$name, $email, $hash, $phone, $avatarPath]);
    }

    public function updateUser(int $id, string $name, string $email, string $phone, string $avatarPath): void
    {
        $stmt = $this->pdo->prepare('UPDATE users SET name = ?, email = ?, phone = ?, avatar = ? WHERE id = ?');
        $stmt->execute([$name, $email, $phone, $avatarPath, $id]);
    }

    public function deleteUser(int $id): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = ?');
        $stmt->execute([$id]);
    }

    public function login(string $email, string $password)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function register($name, $email, $password){
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
        $stmt->execute([$name, $email, $hash]);
    }
}
