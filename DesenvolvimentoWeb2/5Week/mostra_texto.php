<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrando o texto</title>
    <style>
        p {
            font-weight: <?= (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'negrito') ? 'bold' : 'normal' ?>;
            color: <?= isset($_SESSION['cor']) ? $_SESSION['cor'] : 'black' ?>;
        }
    </style>
</head>
<body>
    <h2>Texto exibido:</h2>
    <p>
        <?= isset($_SESSION['txt']) ? htmlspecialchars($_SESSION['txt']) : "Nenhum texto definido ainda." ?>
    </p>
</body>
</html>
