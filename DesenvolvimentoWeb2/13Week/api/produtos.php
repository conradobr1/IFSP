<?php
require '../db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    die(json_encode(['erro' => 'Não autorizado']));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Criar novo produto
    $dados = json_decode(file_get_contents('php://input'), true);

    $stmt = $pdo->prepare("INSERT INTO produtos 
        (nome, descricao, data_validade, quantidade, estoque_minimo, ultimo_preco, criado_por)
        VALUES (?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([
        $dados['nome'],
        $dados['descricao'] ?? '',
        $dados['data_validade'] ?? null,
        $dados['quantidade'],
        $dados['estoque_minimo'],
        $dados['ultimo_preco'],
        $_SESSION['user_id']
    ]);

    echo json_encode(['sucesso' => 'Produto cadastrado', 'id' => $pdo->lastInsertId()]);
    exit;
}

// GET - lista todos
$stmt = $pdo->query("SELECT * FROM produtos ORDER BY nome");
echo json_encode($stmt->fetchAll()));