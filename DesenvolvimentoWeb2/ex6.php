<?php
    // Conrado
    $capital = 0;
    $taxa = 0;
    $tempo = 0;
    $juros = 0;

 
    if (isset($_GET['nome1']) && isset($_GET['nome2']) && isset($_GET['nome3'])) {
        $capital = $_GET['nome1'];
        $taxa = $_GET['nome2'];
        $tempo = $_GET['nome3'];

        
        $juros = $capital * ($taxa / 100) * $tempo;
    }

 
    echo "O valor dos juros é: $juros";
?>