<?php
require_once 'student.php';

$student = new Student();
$data = $student->view($_GET['curriculum_id']);
echo json_encode($data);
?>
