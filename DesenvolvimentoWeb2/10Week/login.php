<?php
require 'config.php';
$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    if(!$email || !$senha) $errors[] = "Preencha email e senha.";
    else {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if(!$user || !password_verify($senha, $user['senha'])){
            $errors[] = "Email ou senha inválidos.";
        } else {
            unset($user['senha']);
            $_SESSION['user'] = $user;
            header('Location: my_complaints.php');
            exit;
        }
    }
}
$registered = isset($_GET['registered']);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card">
        <div class="card-body">
          <h3 class="mb-3">Login</h3>
          <?php if($registered): ?>
            <div class="alert alert-success">Cadastro realizado. Faça login.</div>
          <?php endif; ?>
          <?php if($errors): ?>
            <div class="alert alert-danger"><?php echo implode('<br>',$errors); ?></div>
          <?php endif; ?>
          <form method="post">
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Senha</label>
              <input type="password" name="senha" class="form-control" required>
            </div>
            <button class="btn btn-primary">Entrar</button>
            <a href="register.php" class="btn btn-link">Criar conta</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
