<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recebe tipo</title>
    <!-- CSS do Bootstrap: -->
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
    <!-- incluir menu.php -->
     <?php
     $pagina_atual = 'tipo';
    include 'menu.php';
     ?>
    <h2>Selecione o tipo:</h2>
    <form action="recebe_tipo.php">
        <input type="radio" id="n" name="tipo" value="negrito">
        <label for="n">Negrito</label><br>
        <input type="radio" id="normal" name="tipo" value="normal">
        <label for="normal">Normal</label><br>
        <input type="submit">
    </form>
    <!-- JS do Bootstrap -->
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
