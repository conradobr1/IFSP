<?php include 'config.php'; include 'header.php'; ?>

<h2>Submissões</h2>
<?php
$sql = $pdo->query("SELECT s.*, u.usuario FROM submissoes s JOIN usuarios u ON s.usuario_id = u.id ORDER BY data_submissao DESC");
foreach($sql as $s){
    echo "<div style='margin:10px;padding:10px;border:1px solid #ccc;'>";
    echo "<b>{$s['titulo']}</b> por {$s['usuario']}<br>";
    echo "<a href='avalia_submissao.php?id={$s['id']}'>Avaliar</a>";
    echo "</div>";
}
?>
