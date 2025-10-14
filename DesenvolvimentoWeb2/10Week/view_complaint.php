<?php
require 'config.php';
require_login();

$id = intval($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT r.*, u.nome as reclamante_nome FROM reclamacao r JOIN usuarios u ON u.id = r.id_reclamante WHERE r.id = ?");
$stmt->execute([$id]);
$r = $stmt->fetch();
if(!$r) {
    exit('Reclamação não encontrada');
}

// Processar aprovação/reprovação (apenas reclamante e somente quando estado = Resolvida)
$feedback_msg = null;
if($_SERVER['REQUEST_METHOD'] === 'POST' && $r['estado'] === 'Resolvida' && $r['id_reclamante'] == $_SESSION['user']['id']){
    $aprovacao = in_array($_POST['aprovacao'], ['Aprovada','Reprovada']) ? $_POST['aprovacao'] : '';
    $comentario = trim($_POST['comentario']) ?: null;
    $stmt = $pdo->prepare("UPDATE reclamacao SET aprovacao = ?, comentario = ? WHERE id = ?");
    $stmt->execute([$aprovacao,$comentario,$id]);
    $feedback_msg = "Seu feedback foi salvo.";
    // recarrega
    $stmt = $pdo->prepare("SELECT r.*, u.nome as reclamante_nome FROM reclamacao r JOIN usuarios u ON u.id = r.id_reclamante WHERE r.id = ?");
    $stmt->execute([$id]);
    $r = $stmt->fetch();
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Visualizar Reclamação</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">Prefeitura</a>
    <div>
      <a class="btn btn-outline-primary btn-sm" href="my_complaints.php">Voltar</a>
      <?php if(is_admin()): ?><a href="admin.php" class="btn btn-outline-danger btn-sm">Admin</a><?php endif; ?>
      <a class="btn btn-link" href="logout.php">Sair</a>
    </div>
  </div>
</nav>

<div class="container py-4">
  <div class="card">
    <div class="card-body">
      <h4><?=htmlspecialchars($r['titulo'])?></h4>
      <p class="text-muted">Por <?=htmlspecialchars($r['reclamante_nome'])?> em <?= $r['criado_em'] ?></p>
      <p><?=nl2br(htmlspecialchars($r['descricao']))?></p>

      <?php if($r['foto']): ?>
        <img src="uploads/<?=htmlspecialchars($r['foto'])?>" class="img-fluid mb-3" alt="Foto da reclamação">
      <?php endif; ?>

      <p><strong>Estado:</strong> <?=htmlspecialchars($r['estado'])?></p>
      <p><strong>Aprovação:</strong> <?= $r['aprovacao'] ?: '—' ?></p>
      <?php if($r['comentario']): ?>
        <p><strong>Comentário:</strong> <?= nl2br(htmlspecialchars($r['comentario'])) ?></p>
      <?php endif; ?>

      <?php if($feedback_msg): ?>
        <div class="alert alert-success"><?=htmlspecialchars($feedback_msg)?></div>
      <?php endif; ?>

      <?php if($r['estado'] === 'Resolvida' && $r['id_reclamante'] == $_SESSION['user']['id']): ?>
        <hr>
        <h5>Dar feedback sobre a resolução</h5>
        <form method="post">
          <div class="mb-3">
            <label class="form-label">Aprovar resolução?</label>
            <select name="aprovacao" class="form-select" required>
              <option value="">-- selecione --</option>
              <option value="Aprovada" <?= $r['aprovacao'] === 'Aprovada' ? 'selected' : '' ?>>Aprovar</option>
              <option value="Reprovada" <?= $r['aprovacao'] === 'Reprovada' ? 'selected' : '' ?>>Reprovar</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Comentário (opcional)</label>
            <textarea name="comentario" class="form-control" rows="3"><?=htmlspecialchars($r['comentario'] ?? '')?></textarea>
          </div>
          <button class="btn btn-primary">Enviar feedback</button>
        </form>
      <?php endif; ?>

    </div>
  </div>
</div>
</body>
</html>
