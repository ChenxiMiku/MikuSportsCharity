<?php
class Database {
    private $conn;

    public function __construct() {
        $db = require __DIR__ . '/../config/database.php';

        $servername = $db['db_host'];
        $username = $db['db_user'];
        $password = $db['db_password'];
        $dbname = $db['db_name'];

        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
