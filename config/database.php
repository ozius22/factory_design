<?php
class Connection {
    // singleton instance
    private static $instance = null;
    private $conn;

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "users";

    // singleton constructor
    private function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // get the instance of the database class
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // get the database connection
    public function getConnection() {
        return $this->conn;
    }
}
?>