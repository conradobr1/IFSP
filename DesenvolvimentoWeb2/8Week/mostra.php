<?php
session_start();
require 'conexao.php';
$comando = "SELECT p.id, p.nome, u.nome AS criador FROM produtos p JOIN usuarios u ON p.id_criador = u.id ORDER BY p.id DESC";
$sth = $conexao->query($comando);
$produtos = $sth->fetchAll();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Produtos</title>
</head>
<body>
<?php if (isset($_SESSION['nome'])): ?>
    <p>Bem vindo, <?php echo htmlspecialchars($_SESSION['nome'], ENT_QUOTES); ?> | <a href="cadastro_produto.php">Cadastrar Produto</a> | <a href="sair.php">Sair</a></p>
<?php else: ?>
    <p><a href="entrada.php">Entrar</a> | <a href="recebe_usuario.php">Cadastrar</a></p>
<?php endif; ?>
<h2>Lista de Produtos</h2>
<ul>
<?php foreach ($produtos as $p): ?>
    <li>
        <?php echo htmlspecialchars($p['nome'], ENT_QUOTES); ?> (criado por <?php echo htmlspecialchars($p['criador'], ENT_QUOTES); ?>)
        <a href="cadastro_comentario.php?produto_id=<?php echo $p['id']; ?>">Comentar</a>
        <a href="ver_comentarios.php?produto_id=<?php echo $p['id']; ?>">Ver Comentários</a>
    </li>
<?php endforeach; ?>
</ul>
</body>
</html>
