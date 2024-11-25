<?php

namespace App\Services;

use App\Models\Group;

class GroupService
{
    private Group $groupModel;

    public function __construct(Group $groupModel)
    {
        $this->groupModel = $groupModel;
    }

    public function createGroup(string $groupName): bool
    {
        return $this->groupModel->createGroup($groupName);
    }

    public function getGroups(): array
    {
        return $this->groupModel->fetchAllGroups();
    }
}
