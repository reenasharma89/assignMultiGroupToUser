<?php

namespace App\Models;

use PDO;

class Group
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function createGroup(string $groupName): bool
    {
        $stmt = $this->db->prepare("INSERT INTO groups (groupname) VALUES (:groupname)");
        return $stmt->execute([
            'groupname' => $groupName,
        ]);
    }

    public function fetchAllGroups(): array
    {
        $stmt = $this->db->query("SELECT * FROM groups ORDER BY groupname");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
