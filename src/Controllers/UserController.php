<?php

namespace App\Controllers;

use App\Services\UserService;

class UserController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function listUsers(): array
    {
        return $this->userService->getUsers();
    }

    public function createUser(string $name, string $email, string $phone): bool
    {
        return $this->userService->createUser($name, $email, $phone);
    }
}
