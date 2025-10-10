<?php
include("navbar.php");
//Conrado
$servername = 'localhost';
$banco     = 'fotos';
$username  = 'root';
$password  = '';

try {
    $conexao = new PDO("mysql:host=$servername;dbname=$banco", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}


$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['like']) && is_array($_POST['like'])) {
        $mensagem  = "<h3>Imagens curtidas:</h3><ul>";
        foreach ($_POST['like'] as $idImagem) {
            $idSafe = htmlspecialchars($idImagem);
            $mensagem .= "<li>Imagem com ID $idSafe foi curtida.</li>";

            $stmt = $conexao->prepare("UPDATE imagens SET curtidas = curtidas + 1 WHERE id = ?");
            $stmt->execute([$idImagem]);
        }
        $mensagem .= "</ul>";
    } else {
        $mensagem = "<p>Nenhuma imagem foi curtida.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Main</title>
</head>
<body>
<div class="container-fluid">

    <?php if ($mensagem) echo $mensagem; ?>


    <form method="post" action="">
        <?php

        $comando = "SELECT * FROM imagens ORDER BY curtidas DESC;";
        $result = $conexao->query($comando);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $id    = htmlspecialchars($linha['id']);
            $local = htmlspecialchars($linha['local']);
            $curtidas = htmlspecialchars($linha['curtidas']);
                           echo "<div class='form-check' style='margin-bottom:12px;'>";
            echo "<img src='{$local}' width='190' alt='Imagem'><br>";
           
            echo "<input type='checkbox' class='form-check-input' name='like[]' id='like{$id}' value='{$id}'>";
                         echo "<label for='like{$id}'>$curtidas Curtidas</label>";
           
            echo "</div>";
        }
        ?>
                         <input class="btn btn-primary" type="submit" value="Enviar Likes">
    </form>

</div>
</body>
</html>
