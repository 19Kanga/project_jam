<?php
// session_start();
class Database {
    private $host = "localhost";       // Your MySQL host
    private $db_name = "avs";        // Your database name
    private $username = "root";         // Your MySQL username (root for XAMPP)
    private $password = "";             // Your MySQL password (leave empty for XAMPP)
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
