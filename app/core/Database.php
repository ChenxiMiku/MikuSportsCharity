<?php
class Database {
    private $pdo;

    public function __construct() {
        $config = include('../app/config/config.php');
        $db = $config['db'];

        $host = $db['dbHost'];
        $username = $db['dbUser'];
        $password = $db['dbPassword'];
        $dbName = $db['dbName'];
        $charset = $db['dbCharset'];

        $dsn = "mysql:host=$host;dbname=$dbName;charset=$charset";

        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    /**
     * Get the PDO instance
     * @return PDO
     */
    public function getConnection() {
        return $this->pdo;
    }

    public function closeConnection() {
        $this->pdo = null;
    }
}
?>
