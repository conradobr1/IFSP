<?php
session_start();
require 'conexao.php';
if (!isset($_SESSION['id'])) {
    echo "Acesso negado";
    exit;
}
$id_produto = $_POST['id_produto'] ?? '';
$comentario = $_POST['comentario'] ?? '';
if ($id_produto === '' || trim($comentario) === '') {
    echo "Dados incompletos";
    exit;
}
$comando = "INSERT INTO comentarios (comentario, id_produto, id_comentador) VALUES (:comentario, :id_produto, :id_comentador)";
$sth = $conexao->prepare($comando);
$resultado = $sth->execute([':comentario' => $comentario, ':id_produto' => $id_produto, ':id_comentador' => $_SESSION['id']]);
if ($resultado) {
    header('Location: mostra.php');
    exit;
} else {
    echo "Erro ao salvar comentário";
}
