<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recebe o tipo do texto</title>
</head>
<body>
    <?php
    if( isset($_GET['tipo'])) {
        echo "Tipo recebido!";
        if($_GET['tipo'] != '') {
            session_start();
            $_SESSION['tipo'] = $_GET['tipo'];
            echo "Tipo salvo na sessão!";
        } else {
            echo "Tipo vazio!";
        }
    } else {
        echo "Selecione um tipo!";
    }
    ?>
</body>
</html>