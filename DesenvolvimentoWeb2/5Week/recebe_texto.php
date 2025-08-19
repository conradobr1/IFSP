<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recebe texto</title>
</head>
<body>
    <?php
    session_start(); 

    if (isset($_GET['texto'])) {
        echo "Texto recebido!<br>";

        if (!empty($_GET['texto'])) {
            $_SESSION['txt'] = $_GET['texto'];
            echo "Texto salvo na sessão!<br>";
            echo "Valor atual: " . htmlspecialchars($_SESSION['txt']);
        } else {
            echo "Texto vazio, preencha o formulário!";
        }
    } else {
       
        if (isset($_SESSION['txt'])) {
            echo "Texto já salvo na sessão: " . htmlspecialchars($_SESSION['txt']);
        } else {
            echo "Envie o texto!";
        }
    }
    ?>
</body>
</html>
