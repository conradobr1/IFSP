<?php
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') die(json_encode(['erro' => 'Método não permitido']));

$dados = json_decode(file_get_contents('php://input'), true);

$email = $dados['email'] ?? '';
$senha = $dados['senha'] ?? '';

$stmt = $pdo->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($senha, $user['senha'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_nome'] = $user['nome'];
    echo json_encode(['sucesso' => 'Login realizado', 'nome' => $user['nome']]);
} else {
    http_response_code(401);
    echo json_encode(['erro' => 'Credenciais inválidas']);
}