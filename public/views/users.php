<?php
    // Include the header
    include 'partials/header.php';
    // Include the sidebar
    include 'partials/sidebar.php';
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h1>User Management</h1>

            <!-- Add User Button -->
            <a href="add_user.php" class="btn btn-primary mb-3">Add New User</a>

            <!-- Users Table -->
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../src/controllers/users_controller.php';
                    $controller = new UserController();
                    $users = $controller->getAllUsers();

                    foreach ($users as $user) {
                        echo "<tr>";
                        echo "<td>{$user['id']}</td>";
                        echo "<td>{$user['username']}</td>";
                        echo "<td>{$user['role']}</td>";
                        echo "<td>
                            <a href='edit_user.php?id={$user['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='delete_user.php?id={$user['id']}' class='btn btn-danger btn-sm'>Delete</a>
                        </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?php
    // Include the footer
    include 'partials/footer.php';
?>
