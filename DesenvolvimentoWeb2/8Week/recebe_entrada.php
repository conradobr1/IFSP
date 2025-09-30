<?php
session_start();
require 'conexao.php';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
if ($email === '' || $senha === '') {
    echo "Dados incompletos";
    exit;
}
$comando = "SELECT id, nome, senha FROM usuarios WHERE email = :email LIMIT 1";
$sth = $conexao->prepare($comando);
$sth->execute([':email' => $email]);
$linha = $sth->fetch();
if ($linha && password_verify($senha, $linha['senha'])) {
    $_SESSION['id'] = $linha['id'];
    $_SESSION['nome'] = $linha['nome'];
    header('Location: mostra.php');
    exit;
} else {
    echo "Usuário ou senha inválidos";
}
