<?php
require_once 'student.php';

$student = new Student();
$data = $student->view($_GET['student_id']);
echo json_encode($data);
?>
