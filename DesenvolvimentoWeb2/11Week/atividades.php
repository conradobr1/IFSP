<?php include 'config.php'; include 'header.php'; ?>
<h2>Atividades</h2>
<?php
$sql = $pdo->query("SELECT a.*, u.usuario FROM atividades a JOIN usuarios u ON a.usuario_id = u.id ORDER BY data_criacao DESC");
foreach($sql as $a){
    echo "<div style='margin:10px;padding:10px;border:1px solid #ccc;'>";
    echo "<b>{$a['titulo']}</b> por {$a['usuario']}<br>";
    echo "<a href='participa_atividade.php?id={$a['id']}'>Participar</a>";
    echo "</div>";
}
?>
