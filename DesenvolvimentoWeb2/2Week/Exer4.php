<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Exercicio 4</title>
</head>
<body>
  <!-- Conrado -->
</body>
</html>

<?php

$x = isset($_GET['num1']) ? (int)$_GET['num1'] : 0;
$y = isset($_GET['num2']) ? (int)$_GET['num2'] : 0;

echo "<h2>Comparação entre $x e $y</h2>";

if ($x > $y) {
    echo "<p>$x é maior que $y</p>";
} else {
    echo "<p>$x não é maior que $y</p>";
}

if ($x < $y) {
    echo "<p>$x é menor que $y</p>";
} else {
    echo "<p>$x não é menor que $y</p>";
}

if ($x >= $y) {
    echo "<p>$x é maior ou igual a $y</p>";
} else {
    echo "<p>$x não é maior ou igual a $y</p>";
}

if ($x <= $y) {
    echo "<p>$x é menor ou igual a $y</p>";
} else {
    echo "<p>$x não é menor ou igual a $y</p>";
}

if ($x == $y) {
    echo "<p>$x é igual a $y</p>";
} else {
    echo "<p>$x não é igual a $y</p>";
}

if ($x != $y) {
    echo "<p>$x é diferente de $y</p>";
} else {
    echo "<p>$x não é diferente de $y</p>";
}

if ($x <> $y) {
    echo "<p>$x é diferente de $y (usando <>)</p>";
} else {
    echo "<p>$x não é diferente de $y (usando <>)</p>";
}

if ($x === $y) {
    echo "<p>$x é idêntico a $y</p>";
} else {
    echo "<p>$x não é idêntico a $y</p>";
}

if ($x !== $y) {
    echo "<p>$x não é idêntico a $y</p>";
} else {
    echo "<p>$x é idêntico a $y</p>";
}

$result = $x <=> $y;
if ($result === -1) {
    echo "<p>$x é menor que $y (espaçonave)</p>";
} elseif ($result === 0) {
    echo "<p>$x é igual a $y (espaçonave)</p>";
} else {
    echo "<p>$x é maior que $y (espaçonave)</p>";
}
?>