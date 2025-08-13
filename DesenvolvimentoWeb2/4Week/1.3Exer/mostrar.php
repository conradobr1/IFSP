<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
</head>
<body>
     <ul class="nav nav-underline bg-light p-3">
        <h3 class="text-primary">Exercicio Sessão</h3>
        <li class="nav-item">
            <a class="nav-link text-primary fs-5" href="primeira.php"><strong>Primeira</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-primary fs-5" href="mostrar.php"><strong>Mostra</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-primary fs-5" href="encerrar.php"><strong>Encerrar</strong></a>
        </li>
    </ul>
<?php
session_start();
include 'includes/navbar.php';
?>

    
<div class="container">
    <h1>Nome do Usuário</h1>
    <?php if (isset($_SESSION['nome'])): ?>
        <p>Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</p>
        <a href="encerrar.php" class="btn btn-danger">Encerrar Sessão</a>
    <?php else: ?>
        <p>Nome não encontrado. Por favor, <a href="primeira.php">clique aqui</a> para inserir seu nome.</p>
    <?php endif; ?>
</div>

</body>
