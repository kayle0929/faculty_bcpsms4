<?php
session_start();
require '..\..\..\db.php'; // Include the database connection class
$database = new Database();
$db = $database->getConnection(); // Get the connection

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Fetch user's information from the database
$username = $_SESSION['user'];
$query = "SELECT first_name, last_name, middle_name, suffix FROM admin WHERE username = :username LIMIT 1";
$stmt = $db->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="profile">
    <h2>User Profile</h2>
    <p><strong>First Name:</strong> <?php echo htmlspecialchars($userData['first_name']); ?></p>
    <p><strong>Middle Name:</strong> <?php echo htmlspecialchars($userData['middle_name']); ?></p>
    <p><strong>Last Name:</strong> <?php echo htmlspecialchars($userData['last_name']); ?></p>
    <p><strong>Suffix:</strong> <?php echo htmlspecialchars($userData['suffix']); ?></p>
</div>
