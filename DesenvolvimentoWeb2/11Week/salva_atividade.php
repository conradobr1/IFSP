<?php
include 'config.php';
$stmt = $pdo->prepare("INSERT INTO atividades (usuario_id, titulo, comentario) VALUES (?, ?, ?)");
$stmt->execute([$_SESSION['usuario_id'], $_POST['titulo'], $_POST['comentario']]);
echo "<script>alert('Atividade criada!');window.location='atividades.php';</script>";
?>
