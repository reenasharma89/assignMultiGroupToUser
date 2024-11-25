<?php

namespace App\Models;

use PDO;

class UserGroup
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function assignGroupsToUser(int $userId, array $groupIds): void
    {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare("DELETE FROM user_groups WHERE userid = :userid");
            $stmt->execute(['userid' => $userId]);

            foreach ($groupIds as $groupId) {
                $stmt = $this->db->prepare("INSERT INTO user_groups (userid, groupid) VALUES (:userid, :groupid)");
                $stmt->execute([
                    'userid' => $userId,
                    'groupid' => $groupId,
                ]);
            }

            $this->db->commit();
        } catch (\Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function fetchUserGroups(): array
    {
        $stmt = $this->db->query("
            SELECT users.name AS username, GROUP_CONCAT(groups.groupname SEPARATOR ', ') AS groups,
            users.email, users.name, users.userid
            FROM user_groups
            INNER JOIN users ON user_groups.userid = users.userid
            INNER JOIN groups ON user_groups.groupid = groups.groupid
            GROUP BY users.userid, users.name
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
