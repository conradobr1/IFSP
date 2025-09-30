
<?php
$servername = 'localhost';
$banco = 'opina';
$username = 'root';
$password = '';
try {

    //Conrado
    $conexao = new PDO("mysql:host=$servername;dbname=$banco;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
    exit;
}
