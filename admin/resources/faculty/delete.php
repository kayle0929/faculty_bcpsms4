<?php
require_once 'student.php';

$student = new Student();
$student->delete($_POST['fac_id']);
?>
