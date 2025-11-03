<?php 
include 'config.php'; 
include 'header.php'; 
?>
<h2 class="mb-4">Atividades</h2>

<?php
$sql = $pdo->query("SELECT a.*, u.usuario FROM atividades a JOIN usuarios u ON a.usuario_id = u.id ORDER BY data_criacao DESC");

if ($sql->rowCount() == 0) {
    echo "<div class='alert alert-info'>Nenhuma atividade criada ainda.</div>";
} else {
    foreach($sql as $a) {
?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($a['titulo']) ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">Por: <?= htmlspecialchars($a['usuario']) ?></h6>
                <p class="card-text"><?= nl2br(htmlspecialchars($a['comentario'])) ?></p>
                <a href="participa_atividade.php?id=<?= $a['id'] ?>" class="btn btn-outline-primary btn-sm">Participar</a>
            </div>
        </div>
<?php
    }
}
?>

<?php include 'footer.php';  ?>