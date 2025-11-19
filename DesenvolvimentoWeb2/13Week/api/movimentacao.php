<?php
require '../db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    die(json_encode(['erro' => 'Não autorizado']));
}

$dados = json_decode(file_get_contents('php://input'), true);

$id_produto = $dados['id_produto'];
$tipo = $dados['tipo']; // 'entrada' ou 'saida'
$quantidade = (int)$dados['quantidade'];
$novo_preco = $dados['novo_preco'] ?? null;
$nova_validade = $dados['nova_validade'] ?? null;

$pdo->beginTransaction();

try {
    $stmt = $pdo->prepare("SELECT quantidade, ultimo_preco, data_validade FROM produtos WHERE id = ?");
    $stmt->execute([$id_produto]);
    $prod = $stmt->fetch();

    if (!$prod) throw new Exception('Produto não encontrado');

    $nova_qtd = $tipo === 'entrada' ? $prod['quantidade'] + $quantidade : $prod['quantidade'] - $quantidade;

    if ($nova_qtd < 0) throw new Exception('Estoque não pode ficar negativo');

    $alteracoes = [
        'tipo_movimentacao' => $tipo,
        'quantidade_alterada' => $quantidade,
        'quantidade_anterior' => $prod['quantidade'],
        'quantidade_nova' => $nova_qtd
    ];

    $updates = ["quantidade = ?"];
    $params = [$nova_qtd];

    if ($novo_preco !== null && $novo_preco != $prod['ultimo_preco']) {
        $alteracoes['preco_anterior'] = $prod['ultimo_preco'];
        $alteracoes['preco_novo'] = $novo_preco;
        $updates[] = "ultimo_preco = ?";
        $params[] = $novo_preco;
    }

    if ($nova_validade && $nova_validade !== $prod['data_validade']) {
        $alteracoes['validade_anterior'] = $prod['data_validade'];
        $alteracoes['validade_nova'] = $nova_validade;
        $updates[] = "data_validade = ?";
        $params[] = $nova_validade;
    }

    // Atualiza produto
    $sql = "UPDATE produtos SET " . implode(', ', $updates) . " WHERE id = ?";
    $params[] = $id_produto;
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    // Salva alteração
    $stmt = $pdo->prepare("INSERT INTO alteracoes (id_produto, id_usuario, alteracoes) VALUES (?, ?, ?)");
    $stmt->execute([$id_produto, $_SESSION['user_id'], json_encode($alteracoes, JSON_UNESCAPED_UNICODE)]);

    $pdo->commit();
    echo json_encode(['sucesso' => 'Movimentação registrada com sucesso']);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['erro' => $e->getMessage()]);
}