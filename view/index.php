<?php
    require $_SERVER["DOCUMENT_ROOT"] . '/factory/model/userFactory.php';

    // gets the user type from the URL
    $userType = isset($_GET['type']) ? $_GET['type'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div>
        <h1>
            <?php
            // to display the appropriate heading
            if ($userType === "customer") {
                echo "Customers";
            } elseif ($userType === "supplier") {
                echo "Suppliers";
            } else {
                echo "Unknown User Type";
            }
            ?>
        </h1>
    </div>
    
    <a href="../">
        <button>
            Back
        </button>
    </a>

    <table>
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Contact Number</th>
            <th>Address</th>
        </thead>

        <tbody>
            <?php
            // create an array of user objects based on the user type
            if ($userType === "customer" || $userType === "supplier") {
                $users = UserFactory::getDetails($userType);

                // check if user data exists and handle accordingly
                if (!empty($users)) {
                    foreach ($users as $user) {
                        ?>
                        <tr>
                            <td><?php echo $user->getID(); ?></td>
                            <td>
                                <?php
                                if ($userType === "customer") {
                                    echo $user->getFirstName() . ' ' . $user->getLastName();
                                } elseif ($userType === "supplier") {
                                    echo $user->getCompanyName();
                                }
                                ?>
                            </td>
                            <td><?php echo $user->getContactNumber(); ?></td>
                            <td><?php echo $user->getAddress(); ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="4">User not found or Empty Database</td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>

    </table>

    <a href="../">
        <button>
            Back
        </button>
    </a>
</body>
</html>