<?php
require 'config.php';
require_admin();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['novo_estado'])){
    $id = intval($_POST['id']);
    $novo = $_POST['novo_estado'];
    $allowed = ['Atribuída','Em andamento','Resolvida'];
    if(in_array($novo, $allowed)){
        $stmt = $pdo->prepare("UPDATE reclamacao SET estado = ? WHERE id = ?");
        $stmt->execute([$novo,$id]);
        header('Location: admin.php?updated=1');
        exit;
    }
}

$stmt = $pdo->query("SELECT r.*, u.nome as reclamante_nome FROM reclamacao r JOIN usuarios u ON u.id = r.id_reclamante ORDER BY r.criado_em DESC");
$all = $stmt->fetchAll();
$updated = isset($_GET['updated']);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin - Reclamações</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">Admin - Prefeitura</a>
    <div>
      <a class="btn btn-outline-primary btn-sm" href="create_complaint.php">Nova</a>
      <a class="btn btn-link" href="logout.php">Sair</a>
    </div>
  </div>
</nav>

<div class="container py-4">
  <?php if($updated): ?><div class="alert alert-success">Estado atualizado.</div><?php endif; ?>
  <div class="card">
    <div class="card-body">
      <h4>Todas as Reclamações</h4>
      <?php if(empty($all)): ?>
        <p>Nenhuma reclamação registrada.</p>
      <?php else: ?>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th><th>Título</th><th>Reclamante</th><th>Estado</th><th>Aprovação</th><th>Criado</th><th>Ação</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($all as $r): ?>
            <tr>
              <td><?= $r['id'] ?></td>
              <td><a href="view_complaint.php?id=<?=$r['id']?>"><?=htmlspecialchars($r['titulo'])?></a></td>
              <td><?=htmlspecialchars($r['reclamante_nome'])?></td>
              <td><?=htmlspecialchars($r['estado'])?></td>
              <td><?= $r['aprovacao'] ?: '—' ?></td>
              <td><?= $r['criado_em'] ?></td>
              <td>
                <form style="display:inline-block" method="post">
                  <input type="hidden" name="id" value="<?=$r['id']?>">
                  <select name="novo_estado" class="form-select form-select-sm" style="width:auto;display:inline-block">
                    <option value="">Alterar...</option>
                    <option value="Atribuída">Atribuída</option>
                    <option value="Em andamento">Em andamento</option>
                    <option value="Resolvida">Resolvida</option>
                  </select>
                  <button class="btn btn-sm btn-primary mt-1">Salvar</button>
                </form>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
</div>
</body>
</html>
