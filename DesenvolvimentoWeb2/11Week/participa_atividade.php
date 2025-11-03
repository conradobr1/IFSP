<?php include 'config.php'; include 'header.php';
$id = $_GET['id'];
$a = $pdo->prepare("SELECT * FROM atividades WHERE id = ?");
$a->execute([$id]);
$atv = $a->fetch(PDO::FETCH_ASSOC);
?>
<h2><?= $atv['titulo'] ?></h2>
<p><?= nl2br($atv['comentario']) ?></p>

<form action="salva_participacao.php" method="POST">
    <input type="hidden" name="atividade_id" value="<?= $id ?>">
    <label>Comentário:</label><br>
    <textarea name="comentario" rows="4" cols="50" required></textarea><br><br>
    <button type="submit">Enviar Resposta</button>
</form>

<h3>Respostas:</h3>
<?php
$part = $pdo->prepare("SELECT p.*, u.usuario FROM participacoes p JOIN usuarios u ON p.usuario_id = u.id WHERE atividade_id = ?");
$part->execute([$id]);
foreach($part as $p){
    echo "<p><b>{$p['usuario']}</b>: ".nl2br($p['comentario'])."</p>";
}
?>
