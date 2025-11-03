<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário - Clube de Escrita</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; margin: 40px; }
        form { background: white; padding: 25px; border-radius: 10px; max-width: 450px; margin: auto; box-shadow: 0 0 8px #aaa; }
        input, button { width: 100%; padding: 10px; margin: 5px 0; border-radius: 5px; border: 1px solid #ccc; }
        button { background: #007bff; color: white; font-weight: bold; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Cadastro de Usuário</h2>
    <form action="salva_usuario.php" method="POST">
        <label>Nome completo:</label>
        <input type="text" name="nome_completo" required>

        <label>Usuário:</label>
        <input type="text" name="usuario" required>

        <label>E-mail:</label>
        <input type="email" name="email" required>

        <label>Data de nascimento:</label>
        <input type="date" name="data_nascimento" required>

        <label>CPF:</label>
        <input type="text" name="cpf" maxlength="14" placeholder="000.000.000-00" required>

        <label>Senha:</label>
        <input type="password" name="senha" required>

        <button type="submit">Cadastrar</button>
    </form>
    <p style="text-align:center;margin-top:10px;">
        Já tem conta? <a href="entrada.php">Entrar</a>
    </p>
</body>
</html>
