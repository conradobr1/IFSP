<?php
require 'config.php';
$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'] ?: null;
    $nascimento = $_POST['nascimento'] ?: null;
    $tipo = 'cidadao'; // Conrado

    if(!$nome || !$email || !$senha){
        $errors[] = "Nome, email e senha são obrigatórios.";
    } else {
        
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        if($stmt->fetch()) $errors[] = "Email já cadastrado.";
    }

    if(empty($errors)){
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome,email,senha,cpf,nascimento,tipo) VALUES (?,?,?,?,?,?)");
        $stmt->execute([$nome,$email,$hash,$cpf,$nascimento,$tipo]);
        header('Location: login.php?registered=1');
        exit;
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Cadastro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="card-title mb-3">Cadastro de Usuário</h3>

          <?php if(!empty($errors)): ?>
            <div class="alert alert-danger">
              <ul class="mb-0">
                <?php foreach($errors as $e) echo "<li>".htmlspecialchars($e)."</li>"; ?>
              </ul>
            </div>
          <?php endif; ?>

          <form method="post">
            <div class="mb-3">
              <label class="form-label">Nome</label>
              <input class="form-control" name="nome" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Senha</label>
              <input type="password" class="form-control" name="senha" required>
            </div>
            <div class="mb-3">
              <label class="form-label">CPF</label>
              <input class="form-control" name="cpf">
            </div>
            <div class="mb-3">
              <label class="form-label">Nascimento</label>
              <input type="date" class="form-control" name="nascimento">
            </div>
            <button class="btn btn-primary">Cadastrar</button>
            <a href="login.php" class="btn btn-link">Já tem conta? Entrar</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
