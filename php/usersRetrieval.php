<?php
require $_SERVER["DOCUMENT_ROOT"] . '/factory/config/database.php';

class UserDataRetriever {
    private $type;
    private $data;

    public function __construct(string $type) {
        $this->type = $type;
        $this->data = $this->retrieveUserData();
    }

    private function retrieveUserData() {
        $db = Connection::getInstance();
        $conn = $db->getConnection();

        if ($this->type === "customer") {
            $sql = "SELECT * FROM customers WHERE deleted_at IS null";
        } elseif ($this->type === "supplier") {
            $sql = "SELECT * FROM suppliers WHERE deleted_at IS null";
        } else {
            throw new Exception("Invalid user type: $this->type");
        }

        $result = $conn->query($sql);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $conn->close();

        return $data;
    }

    public function getData() {
        return $this->data;
    }
}

// $userDataRetriever = new UserDataRetriever('customer');
// $userData = $userDataRetriever->getData();
// var_dump($userData);