<?php
session_start();
$pdo=new PDO("mysql:host=localhost;dbname=ctsite","root","");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $stmt=$pdo->prepare("SELECT * FROM usuarios WHERE usuario=?");
    $stmt->execute([$_POST["usuario"]]);
    $u=$stmt->fetch();
    if($u && password_verify($_POST["senha"],$u["senha"])){
        $_SESSION["id"]=$u["id"];
        $_SESSION["nome"]=$u["nome"];
        header("Location: tarefas.php");
        exit;
        //Conrado
    }
}
?>
<form method="post">
<input name="usuario" placeholder="Usuário">
<input type="password" name="senha" placeholder="Senha">
<button type="submit">Entrar</button>
<Br><BR><a href="cadastro.php">Criar Cadastro</a>

</form>
