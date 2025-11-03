<?php include 'config.php'; include 'header.php';
$id = $_GET['id'];

$sub = $pdo->prepare("SELECT * FROM submissoes WHERE id = ?");
$sub->execute([$id]);
$s = $sub->fetch(PDO::FETCH_ASSOC);
?>
<h2><?= $s['titulo'] ?></h2>
<p><b>Observações:</b> <?= nl2br($s['observacoes']) ?></p>
<p><a href="uploads/<?= $s['arquivo'] ?>" target="_blank">📄 Abrir arquivo</a></p>

<h3>Avaliações:</h3>
<?php
$aval = $pdo->prepare("SELECT a.*, u.usuario FROM avaliacoes a JOIN usuarios u ON a.usuario_id = u.id WHERE submissao_id = ?");
$aval->execute([$id]);
if ($aval->rowCount() == 0) echo "Nenhuma avaliação ainda.";
foreach($aval as $a){
    $res = $a['aprovado'] ? "✅ Aprovado" : "❌ Reprovado";
    echo "<p><b>{$a['usuario']}</b>: $res<br>".nl2br($a['comentario'])."</p>";
}
?>
