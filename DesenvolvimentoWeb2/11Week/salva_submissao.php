<?php
include 'config.php';

if (!isset($_SESSION['usuario_id'])) { header("Location: entrada.php"); exit; }

$titulo = $_POST['titulo'];
$obs = $_POST['observacoes'];
$arquivo = $_FILES['arquivo'];

if ($arquivo['error'] == 0) {
    $ext = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['pdf','txt'])) {
        die("Tipo de arquivo inválido!");
    }

    $nome_arquivo = uniqid() . "." . $ext;
    move_uploaded_file($arquivo['tmp_name'], "uploads/" . $nome_arquivo);

    $stmt = $pdo->prepare("INSERT INTO submissoes (usuario_id, titulo, observacoes, arquivo) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_SESSION['usuario_id'], $titulo, $obs, $nome_arquivo]);

    echo "<script>alert('Submissão enviada!');window.location='minhas_submissoes.php';</script>";
} else {
    echo "Erro ao enviar arquivo.";
}
?>
