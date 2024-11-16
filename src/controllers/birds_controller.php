<?php
// Controller for managing Birds module
// Include the necessary model and handle operations like adding, updating, and deleting birds entries.

require_once '../models/bird.php';
require_once __DIR__ . '/../config/database.php';

class BirdController {
    private $db;
    private $bird;
    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
        $this->bird = new Bird($this->db);
    }
    public function addBird($data) {
        // $bird = new Bird();
        return $this->bird->create($data);
    }

    public function getAllBirds() {
        // $bird = new Bird();
        return $this->bird->getAll();
    }

    public function updateBird($id, $data) {
        // $bird = new Bird();
        return $this->bird->update($id, $data);
    }

    public function deleteBird($id) {
        // $bird = new Bird();
        return $this->bird->delete($id);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new BirdController();
    $action = $_GET['action'];

    if ($action === 'all') {
        try {
            $birds = $controller->getAllBirds();
            $datar=[];
            foreach ($birds as $bird) {
                $datar[]=[
                                "id"=>$bird['id'],
                                "bird_identifier"=>$bird['bird_identifier'],
                                "species"=>$bird['species'],
                                "gender"=>$bird['gender'],
                                "purchase_date"=>$bird['purchase_date'],
                                "purchase_cost"=>$bird['purchase_cost'],
                            ];
            };

            $response=[
                "data"=>$datar
            ];
           
            echo json_encode($response);

        } catch (PDOException $e) {
            echo json_encode([
                'success' => false,
                'message' => "error"
            ]);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new BirdController();
        try {
                $datar = [
                    "remark" => $_POST['remark'],
                    "breeding_at_purchase" => $_POST['breeding_at_purchase'],
                    "species" => $_POST['species'],
                    "gender" => $_POST['gender'],
                    "purchase_date" => $_POST['purchase_date'],
                    "purchase_cost" => $_POST['purchase_cost'],
                    "purchased_from" => $_POST['purchased_from'],
                    "age_at_purchase" => $_POST['age_at_purchase'],
                    "hatched_date" => $_POST['hatched_date'],
                    "weight_at_purchase" => $_POST['weight_at_purchase'],
                ];
                $controller->addBird($datar);
                    echo json_encode([
                        'success' => true,
                        'message' => "Bird saved successful"
                    ]);
           
        } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->errorInfo
        ]);
        }
}

