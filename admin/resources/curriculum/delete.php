<?php
require_once 'student.php';

$student = new Student();
$student->delete($_POST['curriculum_id']);
?>
