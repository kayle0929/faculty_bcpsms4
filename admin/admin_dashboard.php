<?php
session_start();
require '../db.php'; // Include the database connection class
$database = new Database();
$db = $database->getConnection(); // Get the connection

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Fetch user's details from the database
$username = $_SESSION['user'];
$query = "SELECT first_name, last_name, middle_name, suffix FROM admin WHERE username = :username LIMIT 1";
$stmt = $db->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

$fullName = htmlspecialchars($userData['first_name'] . ' ' . $userData['last_name']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Sms4</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        #profileSection, #professorsContainer, #curriculumSection, #facultySection {
            display: none; /* Start all sections hidden */
            position: absolute; /* Absolute positioning */
            top: 84px; /* Adjust based on your layout */
            left: 293px; /* Adjust to align with your content */
            width: 74%; /* Set a width */
            height: calc(100% - 84px); /* Fill remaining height below the nav */
            padding: 0; /* No padding */
            border: none; /* Remove border */
            background-color: #f9f9f9; /* Background color */
            z-index: 10; /* Ensure it appears above other elements */
        }

        iframe {
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            border: none; /* Remove border */
            margin: 0; /* No margin */
            padding: 0; /* No padding */
            overflow: auto; /* Allow scrolling if needed */
        }
    </style>
</head>
<body>
    <div id="sidenav" class="sidenav">
        <img src="image/bcp_logo.png" alt="Logo" class="bcplogo">
        <ul class="nav-link">
            <li class="bellNotiff">
                <a href="#" class="active">
                    <i class='bx bx-bell'></i>
                </a>
            </li>
            <li class="userProfile">
                <a href="#" onclick="toggleProfile()">
                    <i class='bx bx-user'></i>
                </a>
            </li>
            <img src="avatar.jpg" alt="Avatar" class="avatar">
            <table class="user-profile">
                <tr>
                    <td><span class="user-name"><b><?php echo $fullName; ?></b></span></td>
                </tr>
                <tr>
                    <td><span class="user-mail"><?php echo htmlspecialchars($username); ?></span></td>    
                </tr>
            </table>
        </ul>

        <table class="dashboard">
            <tr>
                <td>
                    <ul class="nav-links">
                        <li>
                            <a href="#">
                                <i class='bx bx-grid-alt'></i>
                                <span class="links_name">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" onclick="toggleProfile()">
                                <i class='bx bx-user'></i>
                                <span class="links_name">Sms Profile</span>
                            </a>
                        </li>
                    </ul>
                </td>
            </tr>
        </table>

        <div class="section">
            <span class="main"><b>CURRICULUM</b></span>
            <ul class="nav-links">
                <li>
                    <a href="#" onclick="toggleCurriculum()">
                        <i class='bx bx-file'></i>
                        <span class="links_name">Reports</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="section">
            <span class="main"><b>PROFESSOR</b></span>
            <ul class="nav-links">
                <li>
                    <a href="#" onclick="toggleProfessors()">
                        <i class='bx bx-file'></i>
                        <span class="links_name">PROFESSOR</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="section">
            <span class="main"><b>FACULTY</b></span>
            <ul class="nav-links">
                <li>
                    <a href="#" onclick="toggleFaculty()">
                        <i class='bx bx-file'></i>
                        <span class="links_name">FACULTY</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="section">
    <span class="main"><b>SCHEDULE</b></span>
    <ul class="nav-links">
        <li>
            <a href="#" onclick="toggleSchedule()">
                <i class='bx bx-calendar'></i>
                <span class="links_name">SCHEDULE</span>
            </a>
        </li>
    </ul>
</div>


        <li class="logout">
            <a href="logout.php">
                <i class='bx bx-log-out'></i>
                <span class="links_name">Logout</span>
            </a>
        </li>
    </div>

    <div id="uppernav">
        <div class="upnav">
            <button class="openbtn" onclick="toggleNav()">☰</button>
        </div>
    </div>

    <div id="curriculumSection" style="display: none;">
        <iframe src="resources/curriculum/index.php" scrolling="yes"></iframe>
    </div>

    <div id="profileSection">
        <iframe src="resources/sms_profile/sms_profile.php" scrolling="yes"></iframe>
    </div>

    <div id="professorsContainer">
        <iframe src="resources/professor/index.php" scrolling="yes"></iframe>
    </div>

    <div id="facultySection">
        <iframe src="resources/faculty/index.php" scrolling="yes"></iframe>
    </div>

    <script type="text/javascript">
        function toggleNav() {
            const sidenav = document.getElementById("sidenav");
            const uppernav = document.getElementById("uppernav");

            if (sidenav.style.left === "0px") {
                sidenav.style.left = "-280px";
                uppernav.style.marginLeft = "0";
            } else {
                sidenav.style.left = "0";
                uppernav.style.marginLeft = "280px";
            }
        }

        function toggleProfile() {
            const profileSection = document.getElementById("profileSection");
            const professorsContainer = document.getElementById("professorsContainer");
            
            profileSection.style.display = profileSection.style.display === "block" ? "none" : "block";
            professorsContainer.style.display = "none"; // Hide professors section if profile is shown
            document.getElementById("curriculumSection").style.display = "none"; // Hide curriculum if profile is shown
            document.getElementById("facultySection").style.display = "none"; // Hide faculty if profile is shown
        }

        function toggleProfessors() {
            const profileSection = document.getElementById("profileSection");
            const professorsContainer = document.getElementById("professorsContainer");
            
            professorsContainer.style.display = professorsContainer.style.display === "block" ? "none" : "block";
            profileSection.style.display = "none"; // Hide profile section if professors are shown
            document.getElementById("curriculumSection").style.display = "none"; // Hide curriculum if professors are shown
            document.getElementById("facultySection").style.display = "none"; // Hide faculty if professors are shown
        }

        function toggleCurriculum() {
            const curriculumSection = document.getElementById("curriculumSection");
            curriculumSection.style.display = curriculumSection.style.display === "none" ? "block" : "none"; // Toggle visibility
            document.getElementById("profileSection").style.display = "none"; // Hide profile section if curriculum is shown
            document.getElementById("professorsContainer").style.display = "none"; // Hide professors if curriculum is shown
            document.getElementById("facultySection").style.display = "none"; // Hide faculty if curriculum is shown
        }

        function toggleFaculty() {
            const facultySection = document.getElementById("facultySection");
            facultySection.style.display = facultySection.style.display === "none" ? "block" : "none"; // Toggle visibility
            document.getElementById("profileSection").style.display = "none"; // Hide profile section if faculty is shown
            document.getElementById("professorsContainer").style.display = "none"; // Hide professors if faculty is shown
            document.getElementById("curriculumSection").style.display = "none"; // Hide curriculum if faculty is shown
        }
    </script>
</body>
</html>
