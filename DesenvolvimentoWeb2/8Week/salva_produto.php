<?php
session_start();
require 'conexao.php';
if (!isset($_SESSION['id'])) {
    echo "Acesso negado";
    exit;
}
$nome = $_POST['nome'] ?? '';
if ($nome === '') {
    echo "Nome do produto obrigatório";
    exit;
}
$comando = "INSERT INTO produtos (nome, id_criador) VALUES (:nome, :id_criador)";
$sth = $conexao->prepare($comando);
$resultado = $sth->execute([':nome' => $nome, ':id_criador' => $_SESSION['id']]);
if ($resultado) {
    header('Location: mostra.php');
    exit;
} else {
    echo "Erro ao salvar produto";
}
