<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salva cor em SESSION</title>
</head>
<body>
    <?php
session_start();

if (isset($_GET['cor']) && !empty($_GET['cor'])) {
    $_SESSION['cor'] = $_GET['cor'];
    $cor_selecionada = htmlspecialchars($_SESSION['cor']);
    echo "<p style=\"color: " . $cor_selecionada . ";\">Cor salva na sessão: " . $cor_selecionada . "</p>";
} else {
    echo "Nenhuma cor selecionada!";
}
?>

</body>
</html>

