<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cadastro Usuário</title>
</head>
<body>
<form action="salva_usuario.php" method="post">
    <label>Nome:</label>
    <input type="text" name="nome" required><br>
    <label>E-mail:</label>
    <input type="email" name="email" required><br>
    <label>Senha:</label>
    <input type="password" name="senha" required><br>
    <input type="submit" value="Cadastrar">
</form>
</body>
</html>
