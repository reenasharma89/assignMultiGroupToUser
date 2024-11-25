<?php
require_once 'vendor/autoload.php';

use App\Config\Database;
use App\Controllers\UserController;
use App\Services\UserService;
use App\Models\User;

$pdo = Database::getConnection();
$userModel = new User($pdo);
$userService = new UserService($userModel);
$userController = new UserController($userService);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $userController->createUser($name, $email, $phone);
    header('Location: index.php');
    exit;
}

?>
<?php include 'templates/header.php'; ?>
    <div class="container mt-4">
        <h4 class="text-center">Add New User</h4>
        <form method="POST" class="p-4 border rounded">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
    </div>
<?php include 'templates/footer.php'; ?>
