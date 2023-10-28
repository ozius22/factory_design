<?php
require $_SERVER["DOCUMENT_ROOT"] . '/factory/php/usersRetrieval.php';

// interface
abstract class User {
    public $id;
    public $contactNumber;
    public $address;

    public function __construct($id, $contactNumber, $address) {
        $this->id = $id;
        $this->contactNumber = $contactNumber;
        $this->address = $address;
    }

    public function getID() {
        return $this->id;
    }

    public function getContactNumber() {
        return $this->contactNumber;
    }

    public function getAddress() {
        return $this->address;
    }
}

// concrete class
class Customer extends User {
    public $firstName;
    public $lastName;

    public function __construct($id, $contactNumber, $address, $firstName, $lastName) {
        parent::__construct($id, $contactNumber, $address);

        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }
}

// concrete class
class Supplier extends User {
    public $companyName;

    public function __construct($id, $contactNumber, $address, $companyName) {
        parent::__construct($id, $contactNumber, $address);

        $this->companyName = $companyName;
    }

    public function getCompanyName() {
        return $this->companyName;
    }
}

// creator
class UserFactory {
    public static function getDetails(string $type) {
        $userDataRetriever = new UserDataRetriever($type);
        $userData = $userDataRetriever->getData();

        $users = [];

        // concrete products
        if ($type === "customer" || $type === "supplier") {
            foreach ($userData as $userDataEntry) {
                if (!empty($userDataEntry)) {
                    if ($type === "customer") {
                        $users[] = new Customer($userDataEntry['id'], $userDataEntry['contact_number'], $userDataEntry['address'], $userDataEntry['first_name'], $userDataEntry['last_name']);
                    } elseif ($type === "supplier") {
                        $users[] = new Supplier($userDataEntry['id'], $userDataEntry['contact_number'], $userDataEntry['address'], $userDataEntry['company_name']);
                    }
                }
            }
        }

        return $users;
    }
}

// $userFactory = new UserFactory('customer');

// // retrieve the user data
// $users = $userFactory->getDetails('customer');

// // display user information
// foreach ($users as $user) {
//     echo "User ID: " . $user->getID() . "<br>";
//     echo "Name: " . $user->getFirstName() . " " . $user->getLastName() . "<br>";
//     echo "Contact Number: " . $user->getContactNumber() . "<br>";
//     echo "Address: " . $user->getAddress() . "<br>";
//     echo "<br>";
// }
