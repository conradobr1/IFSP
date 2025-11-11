<?php
require 'config.php';

$x = $_GET['x'] ?? 0;

if ($x < 0) {
    echo json_encode(['erro' => 'Número negativo']);
} else {
    echo json_encode(['resultado' => sqrt($x)]);
}
?>
