<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: entrada.php');
    exit;
}
$produto_id = $_GET['produto_id'] ?? '';
if ($produto_id === '') {
    echo "Produto não informado";
    exit;
}
require 'conexao.php';
$comando = "SELECT id, nome FROM produtos WHERE id = :id";
$sth = $conexao->prepare($comando);
$sth->execute([':id' => $produto_id]);
$produto = $sth->fetch();
if (!$produto) {
    echo "Produto não encontrado";
    exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Comentar Produto</title>
</head>
<body>
<h2>Comentando: <?php echo htmlspecialchars($produto['nome'], ENT_QUOTES); ?></h2>
<form action="salva_comentario.php" method="post">
    <input type="hidden" name="id_produto" value="<?php echo $produto['id']; ?>">
    <label>Comentário:</label><br>
    <textarea name="comentario" rows="4" required></textarea><br>
    <input type="submit" value="Salvar Comentário">
</form>
</body>
</html>
