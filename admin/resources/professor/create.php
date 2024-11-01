<?php
require_once 'Professor.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $professor = new Professor();
    $data = [
        'username' => $_POST['username'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        'last_name' => $_POST['last_name'],
        'first_name' => $_POST['first_name'],
        'middle_name' => $_POST['middle_name'],
        'suffix' => $_POST['suffix'],
        'start_date' => $_POST['start_date'],
        'end_date' => $_POST['end_date'],
        'status' => $_POST['status'],
        'notes' => $_POST['notes'],
        'section_id' => $_POST['section'] // Updated here
    ];
    $professor->create($data);
    // Return a success response
}

?>