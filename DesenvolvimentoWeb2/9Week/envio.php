<?php include("navbar.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio</title>
</head>

<body>
    <div class="container-fluid">
        <form action="salva_fotos.php" method='post' enctype='multipart/form-data'>
            <label for="">Imagem:</label>
            <input type="file" name='figura'><br>
            <input type="submit">
        </form>
    </div>
</body>

</html>