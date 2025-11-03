<?php include 'config.php'; include 'header.php'; ?>
<h2>Minhas Submissões</h2>
<?php
$stmt = $pdo->prepare("SELECT * FROM submissoes WHERE usuario_id = ?");
$stmt->execute([$_SESSION['usuario_id']]);
foreach ($stmt as $s) {
    echo "<div style='margin:10px;padding:10px;border:1px solid #ccc;'>";
    echo "<b>{$s['titulo']}</b><br>";
    echo "<a href='visualiza_submissao.php?id={$s['id']}'>Ver detalhes</a>";
    echo "</div>";
}
?>
