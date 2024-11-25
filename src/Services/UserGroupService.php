<?php

namespace App\Services;

use App\Models\UserGroup;

class UserGroupService
{
    private UserGroup $userGroupModel;

    public function __construct(UserGroup $userGroupModel)
    {
        $this->userGroupModel = $userGroupModel;
    }

    public function assignGroups(int $userId, array $groupIds): void
    {
        $this->userGroupModel->assignGroupsToUser($userId, $groupIds);
    }

    public function getUserGroups(): array
    {
        return $this->userGroupModel->fetchUserGroups();
    }

}
