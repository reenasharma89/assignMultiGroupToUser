<?php

namespace App\Controllers;

use App\Services\GroupService;

class GroupController
{
    private GroupService $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    public function createGroup(string $groupName): void
    {
        if (!empty($groupName)) {
            $this->groupService->createGroup($groupName);
        }
    }

    public function listGroups(): array
    {
        return $this->groupService->getGroups();
    }
}
