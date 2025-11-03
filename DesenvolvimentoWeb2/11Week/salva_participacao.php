<?php
include 'config.php';
$stmt = $pdo->prepare("INSERT INTO participacoes (atividade_id, usuario_id, comentario) VALUES (?, ?, ?)");
$stmt->execute([$_POST['atividade_id'], $_SESSION['usuario_id'], $_POST['comentario']]);
echo "<script>alert('Comentário enviado!');history.back();</script>";
?>
