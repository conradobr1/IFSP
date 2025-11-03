<?php include 'config.php'; include 'header.php';
$id = $_GET['id'];
$sql = $pdo->prepare("SELECT * FROM submissoes WHERE id = ?");
$sql->execute([$id]);
$s = $sql->fetch(PDO::FETCH_ASSOC);
?>
<h2>Avaliar Submissão</h2>
<p><b>Título:</b> <?= $s['titulo'] ?></p>
<p><b>Observações:</b> <?= nl2br($s['observacoes']) ?></p>
<p><a href="uploads/<?= $s['arquivo'] ?>" target="_blank">📄 Abrir arquivo</a></p>

<form action="salva_avaliacao.php" method="POST">
    <input type="hidden" name="submissao_id" value="<?= $s['id'] ?>">
    <label>Aprovar?</label>
    <select name="aprovado">
        <option value="1">Sim</option>
        <option value="0">Não</option>
    </select><br><br>
    <label>Comentário:</label><br>
    <textarea name="comentario" rows="4" cols="50"></textarea><br><br>
    <button type="submit">Salvar Avaliação</button>
</form>
