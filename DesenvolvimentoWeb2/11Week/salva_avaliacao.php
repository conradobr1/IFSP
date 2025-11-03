<?php
include 'config.php';

$id = $_POST['submissao_id'];
$aprovado = $_POST['aprovado'];
$comentario = $_POST['comentario'];

$stmt = $pdo->prepare("INSERT INTO avaliacoes (submissao_id, usuario_id, aprovado, comentario) VALUES (?, ?, ?, ?)");
$stmt->execute([$id, $_SESSION['usuario_id'], $aprovado, $comentario]);

echo "<script>alert('Avaliação registrada!');window.location='submissoes.php';</script>";
?>
