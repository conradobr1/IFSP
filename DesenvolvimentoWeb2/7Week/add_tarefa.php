<?php
session_start();
if(!isset($_SESSION["id"])){header("Location: login.php");exit;}
$pdo=new PDO("mysql:host=localhost;dbname=ctsite","root","");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $stmt=$pdo->prepare("INSERT INTO tarefas (nome_tarefa,data_limite,usuario_id) VALUES (?,?,?)");
    $stmt->execute([
        $_POST["nome_tarefa"],
        $_POST["data_limite"],
        $_SESSION["id"]
    ]);
    header("Location: tarefas.php");
    exit;
}
?>
<h2>Adicionar tarefa</h2>
<form method="post">
<input name="nome_tarefa" placeholder="Nome da tarefa" required>
<input type="date" name="data_limite" required>
<button type="submit">Salvar</button>
</form>
<a href="tarefas.php">Voltar</a>
