<?php include 'config.php'; include 'header.php'; ?>
<h2>Criar Atividade</h2>
<form action="salva_atividade.php" method="POST">
    <label>Título:</label><br>
    <input type="text" name="titulo" required><br><br>
    <label>Comentário:</label><br>
    <textarea name="comentario" rows="4" cols="50"></textarea><br><br>
    <button type="submit">Publicar</button>
</form>
