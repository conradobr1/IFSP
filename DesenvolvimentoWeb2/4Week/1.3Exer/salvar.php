<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'])) {
    $_SESSION['nome'] = htmlspecialchars(trim($_POST['nome']));
    header('Location: mostrar.php');
    exit();
} else {
    header('Location: primeira.php');
    exit();
}

//Conrado
?>

