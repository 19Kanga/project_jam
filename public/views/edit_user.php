<?php
    // Include the header and sidebar
    include 'partials/header.php';
    include 'partials/sidebar.php';

    require_once '../../src/controllers/users_controller.php';
    $controller = new UserController();

    // Fetch user data based on the ID passed in the URL
    if (isset($_GET['id'])) {
        $userId = $_GET['id'];
        $user = $controller->getUserById($userId);

        if (!$user) {
            echo "User not found.";
            exit;
        }
    }

    // Handle form submission for updating user
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'role' => $_POST['role']
        ];
        $controller->updateUser($userId, $data);
        header('Location: users.php');
        exit;
    }
?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h1>Edit User</h1>

            <!-- Edit User Form -->
            <form method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password (Leave blank if you don't want to change it)</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" id="role" name="role">
                        <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="user" <?php echo $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
        </div>
    </section>
</div>

<?php
    include 'partials/footer.php';
?>
