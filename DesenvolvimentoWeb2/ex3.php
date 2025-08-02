<?php
    $resp = $_POST['raio'];
// Conrado
    $raio = $resp;
    $area = pi() * ($raio *$raio);
    echo "Area = $area";
?>