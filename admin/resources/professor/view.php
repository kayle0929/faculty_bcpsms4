<?php
require_once 'Professor.php';

$professor = new Professor();
$data = $professor->view($_GET['professor_id']);
echo json_encode($data);
?>
