<?php
require_once 'Professor.php';

$professor = new Professor();
$professor->delete($_POST['professor_id']);
?>
