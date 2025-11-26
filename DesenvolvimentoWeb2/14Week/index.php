<?php
require 'db.php';


$erro_login = '';
$msg_cadastro = '';
$tipo_msg_cadastro = ''; // para cor (verde ou vermelho)

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Identifica qual formulário foi enviado (login ou cadastro)
    $acao = $_POST['acao'] ?? '';

    // --- LÓGICA DE LOGIN ---
    if ($acao === 'logar') {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($senha, $user['senha'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: dashboard.php");
            exit;
        } else {
            $erro_login = "E-mail ou senha incorretos.";
        }
    }

    // --- LÓGICA DE CADASTRO ---
    elseif ($acao === 'cadastrar') {
    
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        // Verifica se e-mail já existe
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $msg_cadastro = "Este e-mail já está em uso.";
            $tipo_msg_cadastro = "danger"; // Vermelho
        } else {
            // CRIPTOGRAFA A SENHA (Importante!)
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            try {
                $stmt = $pdo->prepare("INSERT INTO usuarios ( email, senha) VALUES ( ?, ?)");
                if ($stmt->execute([ $email, $senha_hash])) {
                    $msg_cadastro = "Conta criada! Tente logar ao lado.";
                    $tipo_msg_cadastro = "success"; // Verde
                } else {
                    $msg_cadastro = "Erro ao cadastrar.";
                    $tipo_msg_cadastro = "danger";
                }
            } catch (PDOException $e) {
                $msg_cadastro = "Erro: " . $e->getMessage();
                $tipo_msg_cadastro = "danger";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso e Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; display: flex; align-items: center; min-height: 100vh; }
        .main-container { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .divider { border-right: 1px solid #ddd; }
        @media (max-width: 768px) { .divider { border-right: none; border-bottom: 1px solid #ddd; margin-bottom: 30px; padding-bottom: 30px; } }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 main-container">
            <div class="row">
                
                <div class="col-md-6 divider px-4">
                    <h3 class="mb-4 text-primary">Login</h3>
                    
                    <?php if (!empty($erro_login)): ?>
                        <div class="alert alert-danger py-2"><?= $erro_login ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <input type="hidden" name="acao" value="logar">
                        
                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" name="email" class="form-control" required placeholder="exemplo@email.com">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" name="senha" class="form-control" required placeholder="********">
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </div>
                    </form>
                </div>

                <div class="col-md-6 px-4">
                    <h3 class="mb-4 text-success">Criar nova conta</h3>
                    
                    <?php if (!empty($msg_cadastro)): ?>
                        <div class="alert alert-<?= $tipo_msg_cadastro ?> py-2"><?= $msg_cadastro ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <input type="hidden" name="acao" value="cadastrar">
                        
                      

                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" name="email" class="form-control" required placeholder="exemplo@email.com">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" name="senha" class="form-control" required placeholder="Crie uma senha forte">
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Cadastrar-se</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>