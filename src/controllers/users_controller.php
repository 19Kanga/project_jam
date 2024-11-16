<?php
session_start();
require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../config/database.php';

class UserController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function getAllUsers() {
        try {
            return $this->user->getAllUsers();
        } catch (Exception $e) {
            echo "Error fetching users: " . $e->getMessage();
            return false;
        }
    }

    public function createUser($data) {
        try {
            // Hash the password before saving it to the database
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            return $this->user->createUser($data);
        } catch (Exception $e) {
            echo "Error creating user: " . $e->getMessage();
            return false;
        }
    }

    public function updateUser($id, $data) {
        try {
            // Check if the password field is empty, if so, don't update the password
            if (!empty($data['password'])) {
                // Hash the new password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            } else {
                // Fetch the current password from the database if not changing it
                $currentUser = $this->user->getUserById($id);
                $data['password'] = $currentUser['password']; // Retain the existing password
            }

            return $this->user->updateUser($id, $data);
        } catch (Exception $e) {
            echo "Error updating user: " . $e->getMessage();
            return false;
        }
    }

    public function deleteUser($id) {
        try {
            return $this->user->deleteUser($id);
        } catch (Exception $e) {
            echo "Error deleting user: " . $e->getMessage();
            return false;
        }
    }

    public function getUserById($id) {
        try {
            return $this->user->getUserById($id);
        } catch (Exception $e) {
            echo "Error fetching user: " . $e->getMessage();
            return false;
        }
    }

    public function getUserByUsername($id)
    {
        try {
            return $this->user->getUserByUsername($id);
        } catch (Exception $e) {
            echo "Error fetching user: " . $e->getMessage();
            return false;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UserController();
    $action = $_POST['action'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($action === 'check') {
        try{
            $users = $controller->getUserByUsername($username);
            if (password_verify((string)$password, $users['password'])) {
                $_SESSION['username'] = $users['username'];
                $_SESSION['status'] = 'online';
                $_SESSION['role'] = $users['role'];
                $_SESSION['email'] = $users['email'];
                echo json_encode([
                    'success' => true,
                    'message' => "login successful"
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => "credential failed",
                    'users'=> $users,
                    'verify'=> password_verify($password, $users['password']),
                    'pass'=>$_POST['password']
                ]);
            }
        }catch(PDOException $e){
            echo json_encode([
                'success' => false,
                'message' => "error"
            ]);
        }
    } 
}

