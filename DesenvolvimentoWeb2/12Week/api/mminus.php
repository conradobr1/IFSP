<?php
require 'config.php';

$num_calc = $_GET['num_calc'] ?? 1;
$valor = $_GET['valor'] ?? 0;

$stmt = $pdo->prepare("UPDATE memoria SET valor = valor - ? WHERE num_calc = ?");
$stmt->execute([$valor, $num_calc]);

echo json_encode(['mensagem' => 'Valor subtraído da memória']);
?>
