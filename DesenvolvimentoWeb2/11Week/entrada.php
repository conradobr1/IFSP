<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Login - Clube de Escrita</title>
<style>
body{font-family:Arial;background:#f0f0f0;margin:40px;}
form{background:white;padding:25px;max-width:400px;margin:auto;border-radius:10px;box-shadow:0 0 8px #999;}
input,button{width:100%;padding:10px;margin:6px 0;border:1px solid #ccc;border-radius:5px;}
button{background:#28a745;color:white;font-weight:bold;border:none;cursor:pointer;}
button:hover{background:#218838;}
</style>
</head>
<body>
<h2 style="text-align:center;">Entrar</h2>
<form action="busca_usuario.php" method="POST">
    <label>Usuário ou E-mail:</label>
    <input type="text" name="login" required>

    <label>Senha:</label>
    <input type="password" name="senha" required>

    <button type="submit">Entrar</button>
</form>
<p style="text-align:center;margin-top:10px;">
    Não tem conta? <a href="cadastro_usuario.php">Cadastre-se</a>
</p>
</body>
</html>
