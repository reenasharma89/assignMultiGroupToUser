<?php

namespace App\Controllers;

use App\Services\UserGroupService;
use App\Services\UserService;
use App\Services\GroupService;

class UserGroupController
{
    private UserGroupService $userGroupService;
    private UserService $userService;
    private GroupService $groupService;

    public function __construct(UserGroupService $userGroupService, UserService $userService, GroupService $groupService)
    {
        $this->userGroupService = $userGroupService;
        $this->userService = $userService;
        $this->groupService = $groupService;
    }

    public function assignUserToGroups(int $userId, array $groupIds): void
    {
        if ($userId > 0 && !empty($groupIds)) {
            $this->userGroupService->assignGroups($userId, $groupIds);
        }
    }

    public function listAssignments(): array
    {
        return $this->userGroupService->getUserGroups();
    }

     public function getUsers(): array
     {
         return $this->userService->getUsers();
     }
 
     
     public function getGroups(): array
     {
         return $this->groupService->getGroups();
     }
}
