<?php
require 'config.php';

$x = $_GET['x'] ?? 0;
$y = $_GET['y'] ?? 0;

echo json_encode(['resultado' => $x + $y]);
?>
