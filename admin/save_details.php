<?php
session_start();
require '..\db.php'; // Include the database connection class

class UserDetails {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function saveDetails($username, $firstName, $lastName, $middleName, $suffixName) {
        $query = "INSERT INTO admin_details (username, first_name, last_name, middle_name, suffix_name) VALUES (:username, :first_name, :last_name, :middle_name, :suffix_name)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':middle_name', $middleName);
        $stmt->bindParam(':suffix_name', $suffixName);

        return $stmt->execute(); // Return true on success
    }
}

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $middleName = $_POST['middle_name'];
    $suffixName = $_POST['suffix_name'];

    $userDetails = new UserDetails($db);
    $success = $userDetails->saveDetails($username, $firstName, $lastName, $middleName, $suffixName);

    echo json_encode(["success" => $success]);
}
?>
