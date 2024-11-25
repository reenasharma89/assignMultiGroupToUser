<?php

namespace App\Models;

use PDO;

class User
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function createUser(string $name, string $email, string $phone): bool
    {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, phone) VALUES (:name, :email, :phone)");
        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ]);
    }

    public function fetchAllUsers(): array
    {
        $stmt = $this->db->query("SELECT * FROM users ORDER BY name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
