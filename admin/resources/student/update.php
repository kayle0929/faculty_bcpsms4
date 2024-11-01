<?php
require_once 'student.php';

$student = new Student();
$data = [
    'student_id' => $_POST['student_id'],
    'username' => $_POST['username'],
    'password' => $_POST['password'], // Don't forget to handle password securely!
    'first_name' => $_POST['first_name'],
    'middle_name' => $_POST['middle_name'],
    'last_name' => $_POST['last_name'],
    'email' => $_POST['email'],
    'phone_number' => $_POST['phone_number'],
    'major' => $_POST['major'],
    'enrollment_year' => $_POST['enrollment_year'],
    'status' => $_POST['status'],
    'section' => $_POST['section']
];

$student->update($data);
?>
