<?php
    require_once '../../src/controllers/users_controller.php';

    // Check if the user ID is passed in the URL and delete the user
    if (isset($_GET['id'])) {
        $userId = $_GET['id'];
        $controller = new UserController();
        $controller->deleteUser($userId);
        header('Location: users.php');
        exit;
    } else {
        echo "User ID not provided.";
        exit;
    }
?>
