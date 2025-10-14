<?php
require 'config.php';
require_login();

$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $titulo = trim($_POST['titulo']);
    $descricao = trim($_POST['descricao']);
    $foto_name = null;

    if(!$titulo || !$descricao) $errors[] = "Título e descrição são obrigatórios.";

    // upload simples
    if(isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK){
        $f = $_FILES['foto'];
        $ext = pathinfo($f['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg','jpeg','png','gif'];
        if(!in_array(strtolower($ext), $allowed)) {
            $errors[] = "Formato de imagem não permitido.";
        } else {
            $novo = uniqid('f_') . '.' . $ext;
            if(!move_uploaded_file($f['tmp_name'], __DIR__ . '/uploads/' . $novo)){
                $errors[] = "Falha ao salvar a imagem.";
            } else {
                $foto_name = $novo;
            }
        }
    }

    if(empty($errors)){
        $stmt = $pdo->prepare("INSERT INTO reclamacao (id_reclamante,titulo,descricao,foto,estado) VALUES (?,?,?,?, 'Enviada')");
        $stmt->execute([$_SESSION['user']['id'],$titulo,$descricao,$foto_name]);
        header('Location: my_complaints.php?created=1');
        exit;
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Criar Reclamação</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">Prefeitura - Reclamações</a>
    <div>
      <a class="btn btn-outline-primary btn-sm" href="my_complaints.php">Minhas reclamações</a>
      <?php if(is_admin()): ?>
        <a class="btn btn-outline-danger btn-sm" href="admin.php">Admin</a>
      <?php endif; ?>
      <a class="btn btn-link" href="logout.php">Sair</a>
    </div>
  </div>
</nav>

<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4>Cadastrar Reclamação</h4>
          <?php if(!empty($errors)): ?>
            <div class="alert alert-danger"><?php echo implode('<br>',$errors); ?></div>
          <?php endif; ?>
          <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label class="form-label">Título</label>
              <input class="form-control" name="titulo" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Descrição</label>
              <textarea class="form-control" name="descricao" rows="5" required></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Foto (opcional)</label>
              <input type="file" name="foto" class="form-control">
            </div>
            <button class="btn btn-primary">Enviar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
