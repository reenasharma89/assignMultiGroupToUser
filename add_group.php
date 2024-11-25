<?php
require_once 'vendor/autoload.php';

use App\Config\Database;
use App\Controllers\GroupController;
use App\Services\GroupService;
use App\Models\Group;

$pdo = Database::getConnection();
$groupModel = new Group($pdo);
$groupService = new GroupService($groupModel);
$groupController = new GroupController($groupService);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $groupName = $_POST['group_name'] ?? '';
    $groupController->createGroup($groupName);
    header('Location: index.php');
    exit;
}
?>

<?php include 'templates/header.php'; ?>
<div class="container mt-4">
    <h4 class="text-center">Add New Group</h4>
    <form method="POST" class="p-4 border rounded">
        <div class="mb-3">
            <label for="group_name" class="form-label">Group Name</label>
            <input type="text" class="form-control" id="group_name" name="group_name" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Group</button>
    </form>
</div>
<?php include 'templates/footer.php'; ?>
