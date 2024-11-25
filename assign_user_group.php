<?php
require_once 'vendor/autoload.php';

use App\Config\Database;
use App\Controllers\UserGroupController;
use App\Services\UserService;
use App\Services\GroupService;
use App\Services\UserGroupService;
use App\Models\User;
use App\Models\Group;
use App\Models\UserGroup;

$pdo = Database::getConnection();
$userGroupModel = new UserGroup($pdo);
$userGroupService = new UserGroupService($userGroupModel);

$userModel = new User($pdo);
$userService = new UserService($userModel);

$groupModel = new Group($pdo);
$groupService = new GroupService($groupModel);

$assignUserGroupController = new UserGroupController($userGroupService, $userService, $groupService);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'] ?? '';
    $groupIds = $_POST['group_id'] ?? [];
    if (!empty($userId) && !empty($groupIds)) {
        $assignUserGroupController->assignUserToGroups($userId, $groupIds);
    }
    header('Location: index.php');
    exit;
}

$users = $assignUserGroupController->getUsers();
$groups = $assignUserGroupController->getGroups();
?>

<?php include 'templates/header.php'; ?>
<div class="container mt-4">
    <h4 class="text-center">Assign User to Groups</h4>
    <form method="POST" class="p-4 border rounded">
        <div class="mb-3">
            <label for="user_id" class="form-label">Select User</label>
            <select class="form-control" id="user_id" name="user_id" required>
                <option value="">Select a User</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo $user['userid']; ?>"><?php echo $user['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="group_id" class="form-label">Select Groups</label>
            <select class="form-control" id="group_id" name="group_id[]" multiple required>
                <option value="">Select Groups</option>
                <?php foreach ($groups as $group): ?>
                    <option value="<?php echo $group['groupid']; ?>"><?php echo $group['groupname']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Assign User to Groups</button>
    </form>
</div>
<?php include 'templates/footer.php'; ?>
