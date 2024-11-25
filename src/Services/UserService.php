<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    private User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function createUser(string $name, string $email, string $phone): bool
    {
        return $this->userModel->createUser($name, $email, $phone);
    }

    public function getUsers(): array
    {
        return $this->userModel->fetchAllUsers();
    }
}
