<?php
require 'config.php';
require_login();

$stmt = $pdo->prepare("SELECT * FROM reclamacao WHERE id_reclamante = ? ORDER BY criado_em DESC");
$stmt->execute([$_SESSION['user']['id']]);
$recs = $stmt->fetchAll();
$created = isset($_GET['created']);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Minhas Reclamações</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">Prefeitura</a>
    <div>
      <a class="btn btn-outline-primary btn-sm" href="create_complaint.php">Nova Reclamação</a>
      <?php if(is_admin()): ?><a href="admin.php" class="btn btn-outline-danger btn-sm">Admin</a><?php endif; ?>
      <a class="btn btn-link" href="logout.php">Sair</a>
    </div>
  </div>
</nav>

<div class="container py-4">
  <?php if($created): ?>
    <div class="alert alert-success">Reclamação criada com sucesso.</div>
  <?php endif; ?>

  <div class="card">
    <div class="card-body">
      <h4>Minhas Reclamações</h4>
      <?php if(empty($recs)): ?>
        <p>Nenhuma reclamação encontrada. <a href="create_complaint.php">Criar agora</a>.</p>
      <?php else: ?>
        <div class="list-group">
          <?php foreach($recs as $r): ?>
            <a href="view_complaint.php?id=<?=$r['id']?>" class="list-group-item list-group-item-action">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><?=htmlspecialchars($r['titulo'])?></h5>
                <small><?=htmlspecialchars($r['estado'])?></small>
              </div>
              <p class="mb-1 text-truncate"><?=htmlspecialchars($r['descricao'])?></p>
              <small>Aprovação: <?= $r['aprovacao'] ?: '—' ?></small>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
</body>
</html>
