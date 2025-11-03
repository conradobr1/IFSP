<?php include 'config.php'; include 'header.php'; ?>
<h2>Minhas Atividades</h2>
<?php
$stmt = $pdo->prepare("SELECT * FROM atividades WHERE usuario_id = ?");
$stmt->execute([$_SESSION['usuario_id']]);
foreach ($stmt as $a) {
    echo "<div style='margin:10px;padding:10px;border:1px solid #ccc;'>";
    echo "<b>{$a['titulo']}</b><br>";
    echo nl2br($a['comentario']);
    echo "</div>";
}
?>
<?php include 'footer.php';  ?>
