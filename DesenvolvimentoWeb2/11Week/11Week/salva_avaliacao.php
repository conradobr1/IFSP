<?php
require 'config.php';
require_login();

$id_usuario = $_SESSION['usuario_id'];
$id_sub = $_POST['submissao_id'];
$comentario = $_POST['comentario'];
$aprovado = $_POST['aprovado'];

$stmt = $pdo->prepare("
    INSERT INTO avaliacoes (submissao_id, usuario_id, aprovado, comentario, data_avaliacao)
    VALUES (?, ?, ?, ?, NOW())
");
$stmt->execute([$id_sub, $id_usuario, $aprovado, $comentario]);

header("Location: submissoes.php");
exit;
?>
