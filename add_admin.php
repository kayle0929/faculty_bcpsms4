<?php
require_once 'db.php'; // Include your Database class

// Create a new Database instance and get the connection
$database = new Database();
$conn = $database->getConnection();

// User data
$username = 'admin';
$password = '1234';
$email = 'admin@example.com'; // You can set a default email
$role = 'superadmin'; // Example role

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert query
$sql = "INSERT INTO admin (username, password, email, role) VALUES (:username, :password, :email, :role)";
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $hashed_password);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':role', $role);

try {
    if ($stmt->execute()) {
        echo "New admin user created successfully";
    } else {
        echo "Error creating admin user";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection
$conn = null;
?>
