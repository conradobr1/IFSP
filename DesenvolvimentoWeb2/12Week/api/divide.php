<?php
require 'config.php';

$x = $_GET['x'] ?? 0;
$y = $_GET['y'] ?? 1;

if ($y == 0) {
    echo json_encode(['erro' => 'Divisão por zero']);
} else {
    echo json_encode(['resultado' => $x / $y]);
}
?>
