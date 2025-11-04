<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome_completo']);
    $usuario = trim($_POST['usuario']);
    $email = trim($_POST['email']);
    $nasc = $_POST['data_nascimento'];
    $cpf = trim($_POST['cpf']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Verifica se usuário ou e-mail já existem
    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario OR email = :email");
    $sql->execute(['usuario' => $usuario, 'email' => $email]);
    if ($sql->rowCount() > 0) {
        echo "<script>alert('Usuário ou e-mail já cadastrado!'); history.back();</script>";
        exit;
    }

    // Insere no banco
    $stmt = $pdo->prepare("INSERT INTO usuarios 
        (nome_completo, usuario, email, data_nascimento, cpf, senha) 
        VALUES (:nome, :usuario, :email, :nasc, :cpf, :senha)");

    $stmt->execute([
        'nome' => $nome,
        'usuario' => $usuario,
        'email' => $email,
        'nasc' => $nasc,
        'cpf' => $cpf,
        'senha' => $senha
    ]);

    echo "<script>alert('Cadastro realizado com sucesso!'); window.location='entrada.php';</script>";
} else {
    header("Location: cadastro_usuario.php");
    exit;
}
?>
