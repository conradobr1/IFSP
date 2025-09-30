<?php
require 'conexao.php';
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
if ($nome === '' || $email === '' || $senha === '') {
    echo "Dados incompletos";
    exit;
}
$hash = password_hash($senha, PASSWORD_DEFAULT);
$comando = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
$sth = $conexao->prepare($comando);
$resultado = $sth->execute([':nome' => $nome, ':email' => $email, ':senha' => $hash]);
if ($resultado) {
    echo "Usuário ($nome) salvo com sucesso!";
} else {
    echo "Erro ao salvar o usuário.";
}
