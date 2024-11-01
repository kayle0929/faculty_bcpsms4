<?php
require_once 'Professor.php';

$professor = new Professor();
$data = [
    'username' => $_POST['username'],
    'last_name' => $_POST['last_name'],
    'first_name' => $_POST['first_name'],
    'middle_name' => $_POST['middle_name'],
    'suffix' => $_POST['suffix'],
    'start_date' => $_POST['start_date'],
    'end_date' => $_POST['end_date'],
    'status' => $_POST['status'],
    'notes' => $_POST['notes'],
    'professor_id' => $_POST['professor_id'],
];
$professor->update($data);
?>
