<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecione a cor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
    <?php
    // Conrado
    $pagina_atual = 'cor';
    include 'menu.php';
    ?>

    <div class="container mt-4">
        <h2>Selecione a cor:</h2>
        <form action="recebe_cor.php" method="get">
            <label for="c">Cor:</label>
            <input type="color" id="c" name="cor" required><br><br>
            <input type="submit" value="Enviar" class="btn btn-primary">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
