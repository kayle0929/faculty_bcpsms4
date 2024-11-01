<?php
session_start();
require '..\db.php'; // Include the database connection class

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($username, $password, $first_name, $last_name, $middle_name, $email, $role) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Prepare the SQL query
        $query = "INSERT INTO admin (username, password, first_name, last_name, middle_name, email, role) 
                  VALUES (:username, :password, :first_name, :last_name, :middle_name, :email, :role)";

        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':middle_name', $middle_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);

        // Execute the query
        if ($stmt->execute()) {
            return ["success" => true, "message" => "User created successfully."];
        } else {
            return ["success" => false, "message" => "User could not be created."];
        }
    }
}

// Create a new database connection
$database = new Database();
$db = $database->getConnection();

// Example usage
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $user = new User($db);
    $response = $user->create($username, $password, $first_name, $last_name, $middle_name, $email, $role);
    echo json_encode($response);
}
?>
