<?php
session_start();
require '..\db.php'; // Include the database connection class

class User {
    private $username;
    private $password;
    private $conn;

    public function __construct($username, $password, $db) {
        $this->username = $username;
        $this->password = $password;
        $this->conn = $db;
    }

public function login() {
    // Prepare SQL query to prevent SQL injection
    $query = "SELECT * FROM admin WHERE username = :username LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':username', $this->username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Verify password
        if (password_verify($this->password, $row['password'])) {
            $_SESSION['user'] = $this->username;
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            return ["success" => true];
        } else {
            return ["success" => false, "message" => "Invalid username or password."];
        }
    } else {
        return ["success" => false, "message" => "Invalid username or password."];
    }
}

}

// Create a new database connection
$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User($username, $password, $db);
    $response = $user->login();
    echo json_encode($response);
}
?>
