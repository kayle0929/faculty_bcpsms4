<?php
require_once 'student.php';

$student = new Student();
$data = [
    'curriculum_year' => $_POST['curriculum_year'],
    'period' => $_POST['period'],
    'level' => $_POST['level'],
    'program_code' => $_POST['program_code'],
    'course_code' => $_POST['course_code'],
    'course_name' => $_POST['course_name'],
    'lec' => $_POST['lec'],
    'lab' => $_POST['lab'],
    'units' => $_POST['units'],
    'complab' => $_POST['complab']
];
$student->create($data);
?>
