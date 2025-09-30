<?php
require 'conexao.php';
$produto_id = $_GET['produto_id'] ?? '';
if ($produto_id === '') {
    echo "Produto não informado";
    exit;
}
$comando = "SELECT p.nome AS produto, c.comentario, u.nome AS autor FROM comentarios c JOIN usuarios u ON c.id_comentador = u.id JOIN produtos p ON c.id_produto = p.id WHERE p.id = :id ORDER BY c.id DESC";
$sth = $conexao->prepare($comando);
$sth->execute([':id' => $produto_id]);
$comentarios = $sth->fetchAll();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Comentários</title>
</head>
<body>
<h2>Comentários</h2>
<ul>
<?php foreach ($comentarios as $c): ?>
    <li><?php echo nl2br(htmlspecialchars($c['comentario'], ENT_QUOTES)); ?> — <?php echo htmlspecialchars($c['autor'], ENT_QUOTES); ?></li>
<?php endforeach; ?>
</ul>
<p><a href="mostra.php">Voltar</a></p>
</body>
</html>
