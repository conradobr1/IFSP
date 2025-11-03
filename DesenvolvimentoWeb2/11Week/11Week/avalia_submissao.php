<?php
require 'config.php';
require_login();
include 'footer.php';
include 'header.php';

$id_sub = $_GET['id'] ?? 0;
$id_usuario = $_SESSION['usuario_id'];

// Buscar submissão
$stmt = $pdo->prepare("
    SELECT s.*, u.usuario 
    FROM submissoes s 
    JOIN usuarios u ON s.usuario_id = u.id
    WHERE s.id = ?
");
$stmt->execute([$id_sub]);
$sub = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$sub) {
    echo "<div class='alert alert-danger'>Submissão não encontrada.</div>";
    include 'footer.php';
    exit;
}

// Impede o próprio autor de avaliar
if ($sub['usuario_id'] == $id_usuario) {
    echo "<div class='alert alert-warning'>Você não pode avaliar seu próprio texto.</div>";
    include 'footer.php';
    exit;
}
?>

<h3 class="mb-4">Avaliar Submissão: <?= htmlspecialchars($sub['titulo']) ?></h3>

<div class="card mb-3">
  <div class="card-body">
    <p><strong>Autor:</strong> <?= htmlspecialchars($sub['usuario']) ?></p>
    <p><strong>Observações:</strong> <?= nl2br(htmlspecialchars($sub['observacoes'])) ?></p>
    <a href="uploads/<?= htmlspecialchars($sub['arquivo']) ?>" target="_blank" class="btn btn-outline-secondary mb-3">Ver Arquivo</a>
  </div>
</div>

<form action="salva_avaliacao.php" method="post">
  <input type="hidden" name="submissao_id" value="<?= $sub['id'] ?>">
  <div class="mb-3">
    <label class="form-label">Comentário</label>
    <textarea name="comentario" class="form-control" rows="4" required></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label">Aprovação</label><br>
    <input type="radio" name="aprovado" value="1" required> Aprovar
    <input type="radio" name="aprovado" value="0" class="ms-3"> Reprovar
  </div>
  <button type="submit" class="btn btn-success">Salvar Avaliação</button>
</form>

<?php include 'footer.php'; ?>
