<?php
require_once 'student.php';

$student = new Student();
$data = [
    'fac_id' => $_POST['fac_id'],
    'username' => $_POST['username'],
    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), // Hashing the password
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
    'email' => $_POST['email'],
    'phone_number' => $_POST['phone_number'],
    'hire_date' => $_POST['hire_date'],
    'specialization' => $_POST['specialization'],
    'status' => $_POST['status']
];

$student->update($data);
?>