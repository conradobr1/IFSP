<?php
session_start();

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturar dados do formulário
    $consumo = $_POST['consumo'] ?? '';
    $pao = $_POST['pao'] ?? '';
    $proteina = $_POST['proteina'] ?? '';
    $queijo = $_POST['queijo'] ?? '';
    $vegetais = $_POST['vegetais'] ?? [];
    $molhos = $_POST['molhos'] ?? [];
    $pagamento = $_POST['pagamento'] ?? '';
    
    // Validar campos obrigatórios
    if (empty($consumo) || empty($pao) || empty($proteina) || empty($queijo) || empty($pagamento)) {
        $_SESSION['erro'] = 'Por favor, preencha todos os campos obrigatórios.';
        header('Location: index.php');
        exit;
    }
    
    // Salvar dados na sessão
    $_SESSION['pedido'] = [
        'consumo' => $consumo,
        'pao' => $pao,
        'proteina' => $proteina,
        'queijo' => $queijo,
        'vegetais' => $vegetais,
        'molhos' => $molhos,
        'pagamento' => $pagamento,
        'data_pedido' => date('d/m/Y H:i:s')
    ];
    
    // Redirecionar para página de resumo
    header('Location: resumo_pedido.php');
    exit;
} else {
    // Se não foi enviado via POST, redirecionar para página inicial
    header('Location: index.php');
    exit;
}
?>

