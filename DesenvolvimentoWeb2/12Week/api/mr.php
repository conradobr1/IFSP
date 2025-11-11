<?php
require 'config.php';

$num_calc = $_GET['num_calc'] ?? 1;

$stmt = $pdo->prepare("SELECT valor FROM memoria WHERE num_calc = ?");
$stmt->execute([$num_calc]);
$dado = $stmt->fetch();

if ($dado) {
    echo json_encode(['memoria' => $dado['valor']]);
} else {
    echo json_encode(['erro' => 'Calculadora não encontrada']);
}
?>
