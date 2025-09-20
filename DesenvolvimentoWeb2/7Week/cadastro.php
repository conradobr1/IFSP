<?php
$pdo = new PDO("mysql:host=localhost;dbname=ctsite","root","");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $stmt=$pdo->prepare("INSERT INTO usuarios (usuario,senha,nome,nascimento,cep,numero) VALUES (?,?,?,?,?,?)");
    $stmt->execute([
        $_POST["usuario"],
        password_hash($_POST["senha"],PASSWORD_DEFAULT),
        $_POST["nome"],
        $_POST["nascimento"],
        $_POST["cep"],
        $_POST["numero"]
    ]);
    header("Location: login.php");
}
?>
<form method="post">
<input name="usuario" placeholder="Usuário">
<input type="password" name="senha" placeholder="Senha">
<input name="nome" placeholder="Nome">
<input type="date" name="nascimento">
<input name="cep" placeholder="CEP">
<input name="numero" placeholder="Número">
<button type="submit">Cadastrar</button>
</form>
