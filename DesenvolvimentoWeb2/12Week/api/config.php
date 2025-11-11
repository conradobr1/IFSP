<?php
$pdo = new PDO('mysql:host=localhost;dbname=calculadora;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

header('Content-Type: application/json');
?>
