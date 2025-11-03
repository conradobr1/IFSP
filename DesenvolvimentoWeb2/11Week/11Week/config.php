<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "clube_escrita";

$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Redirecionar se não estiver logado
function require_login() {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: entrada.php");
        exit;
    }
}
?>
