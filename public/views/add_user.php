<?php
// Include the header and sidebar
    include 'partials/headers.php';
    include 'partials/header.php';
    include 'partials/sidebar.php';

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once '../../src/controllers/users_controller.php'; // Correct path
        $controller = new UserController();
        $data = [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'role' => $_POST['role']
        ];
        $controller->createUser($data); // Ensure this method exists in your UserController
        header('Location: users.php');
        exit;
    }
?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h1>Add New User</h1>

            <!-- Add User Form -->
            <form method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" id="role" name="role">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add User</button>
            </form>
        </div>
    </section>
</div>

<?php
    include 'partials/footer.php';
?>
