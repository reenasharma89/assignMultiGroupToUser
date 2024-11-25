<?php require_once 'vendor/autoload.php'; ?>
<?php

use App\Config\Database;

use App\Controllers\GroupController;
use App\Controllers\UserController;
use App\Controllers\UserGroupController;

use App\Models\User;
use App\Models\Group;
use App\Models\UserGroup;

use App\Services\UserService;
use App\Services\GroupService;
use App\Services\UserGroupService;

$pdo = Database::getConnection();

$userModel = new User($pdo);
$userService = new UserService($userModel);
$userController = new UserController($userService);
$users = $userController->listUsers();

$groupModel = new Group($pdo);
$groupService = new GroupService($groupModel);
$groupController = new GroupController($groupService);
$groups = $groupController->listGroups();


$userGroupModel = new UserGroup($pdo);
$userGroupService = new UserGroupService($userGroupModel);
$userGroupController = new UserGroupController($userGroupService, $userService, $groupService);
$usersWithGroups = $userGroupController->listAssignments();

?>
<?php include 'templates/header.php'; ?>
    <div class="container mt-4">
        <div class="row">
            <!-- User List -->
            <div class="col-md-6">
                <h4 class="text-center">Users</h4>
                <div class="card">
                    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['userid']) ?></td>
                                        <td><?= htmlspecialchars($user['name']) ?></td>
                                        <td><?= htmlspecialchars($user['email']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Group List -->
            <div class="col-md-6">
                <h4 class="text-center">Groups</h4>
                <div class="card">
                    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Group Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($groups as $group): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($group['groupid']) ?></td>
                                        <td><?= htmlspecialchars($group['groupname']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
    <h4 class="text-center">Users and Assigned Groups</h4>
    <div class="card">
        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Assigned Groups</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usersWithGroups as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['userid']) ?></td>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['groups']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <?php include 'templates/footer.php'; ?>
    