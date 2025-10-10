<?php
    include("navbar.php");
    $servername = 'localhost';
    $banco = 'fotos';
    $username = 'root';
    $password = '';

    $conexao = new PDO("mysql:host=$servername;dbname=$banco", $username, $password);


    $nome_arquivo = $_FILES['figura']['name'];

    $atual = $_FILES['figura']["tmp_name"];

    $destino = 'imagens/' . $nome_arquivo;

    $resultado_foto = move_uploaded_file($atual, $destino);

    if($resultado_foto) {
        echo "Arquivo recebido com sucesso!";

    } else {
        echo "Erro ao enviar o arquivo!";
    }



    $comando = "INSERT INTO `imagens` (`id`, `local`) VALUES (NULL, '$destino')";

    // preparar
    $sth = $conexao->prepare($comando);

    // executar
    $resultado = $sth->execute();

    // verificar resultado
    if($resultado) {
    echo "<br>Foto salva com sucesso!";

    } else {
    echo "<br>Erro ao salvar o usuário.";
    }
?>