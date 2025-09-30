<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: entrada.php');
    exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cadastro Produto</title>
</head>
<body>
<form action="salva_produto.php" method="post">
    <label>Nome do Produto:</label>
    <input type="text" name="nome" required><br>
    <input type="submit" value="Cadastrar Produto">
</form>
</body>
</html>
