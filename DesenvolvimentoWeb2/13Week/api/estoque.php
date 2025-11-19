<?php
require '../db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    die(json_encode(['erro' => 'Não autorizado']));
}

$stmt = $pdo->query("
    SELECT nome, quantidade, estoque_minimo, data_validade 
    FROM produtos 
    ORDER BY nome
");

$estoque = $stmt->fetchAll();

echo json_encode($estoque);