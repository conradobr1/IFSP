<?php
// config.php
$host = "localhost";
$usuario = "root";       // altere se necessário
$senha = "";             // altere se necessário
$banco = "clube_escrita";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
session_start();
?>
