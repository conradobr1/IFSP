<?php
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') die(json_encode(['erro' => 'Método não permitido']));

$dados = json_decode(file_get_contents('php://input'), true);

$nome = trim($dados['nome'] ?? '');
$email = trim($dados['email'] ?? '');
$senha = $dados['senha'] ?? '';

if (!$nome || !$email || !$senha) {
    die(json_encode(['erro' => 'Todos os campos são obrigatórios']));
}

$hash = password_hash($senha, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $email, $hash]);
    http_response_code(201);
    echo json_encode(['sucesso' => 'Usuário cadastrado com sucesso']);
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        echo json_encode(['erro' => 'E-mail já cadastrado']);
    } else {
        echo json_encode(['erro' => 'Erro ao cadastrar']);
    }
}