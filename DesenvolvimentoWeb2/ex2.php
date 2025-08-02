<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conrado</title>
   
</head>
<body>


    <?php
      $nome = $_GET['raio'];
//Conrado
    $raio = $nome;
    $area = pi() * ($raio *$raio);
    echo "Area = $area";
    ?>

   


</body>
</html>
