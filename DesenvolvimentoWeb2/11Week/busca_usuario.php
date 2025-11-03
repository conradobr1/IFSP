<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $senha = $_POST['senha'];

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :login OR email = :login");
    $sql->execute(['login' => $login]);
    $user = $sql->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario'] = $user['usuario'];
        header("Location: submissoes.php");
        exit;
    } else {
        echo "<script>alert('Login ou senha incorretos');history.back();</script>";
    }
}
?>
