<?php include 'config.php'; include 'header.php'; ?>
<h2>Enviar Submissão</h2>
<form action="salva_submissao.php" method="POST" enctype="multipart/form-data">
    <label>Título:</label><br>
    <input type="text" name="titulo" required><br><br>

    <label>Observações:</label><br>
    <textarea name="observacoes" rows="4" cols="50"></textarea><br><br>

    <label>Arquivo (PDF ou TXT):</label><br>
    <input type="file" name="arquivo" accept=".pdf,.txt" required><br><br>

    <button type="submit">Enviar</button>
</form>
