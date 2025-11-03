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
        // Define uma mensagem de erro na sessão e redireciona de volta
        $_SESSION['login_error'] = "Login ou senha incorretos";
        header("Location: entrada.php");
        exit;
    }
} else {
    // Se não for POST, apenas redireciona para a página de login
    header("Location: entrada.php");
    exit;
}
?>