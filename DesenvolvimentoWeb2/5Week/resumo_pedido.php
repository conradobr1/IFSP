<?php
session_start();

// Verificar se existe um pedido na sessão
if (!isset($_SESSION['pedido'])) {
    header('Location: index.php');
    exit;
}

$pedido = $_SESSION['pedido'];

// Função para formatar nomes
function formatarNome($nome) {
    $nomes = [
        'levar' => 'Levar',
        'local' => 'Comer no local',
        'frances' => 'Pão Francês',
        'integral' => 'Pão Integral',
        'ciabatta' => 'Ciabatta',
        'pita' => 'Pão Pita',
        'baguete' => 'Baguete',
        'carne' => 'Carne',
        'frango' => 'Frango',
        'mussarela' => 'Mussarela',
        'cheddar' => 'Cheddar',
        'prato' => 'Queijo Prato',
        'provolone' => 'Provolone',
        'gorgonzola' => 'Gorgonzola',
        'alface' => 'Alface',
        'tomate' => 'Tomate',
        'cebola' => 'Cebola',
        'pepino' => 'Pepino',
        'pimentao' => 'Pimentão',
        'maionese' => 'Maionese',
        'ketchup' => 'Ketchup',
        'mostarda' => 'Mostarda',
        'barbecue' => 'Barbecue',
        'ranch' => 'Ranch',
        'pix' => 'PIX',
        'cartao' => 'Cartão'
    ];
    
    return $nomes[$nome] ?? ucfirst($nome);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumo do Pedido</title>
    <!-- CSS do Bootstrap: -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
    <!-- incluir menu.php -->
    <?php
    $pagina_atual = 'resumo';
    include 'menu_sanduiche.php';
    ?>
    
    <div class="container mt-4">
        <h1 class="text-center mb-4">Resumo do seu Pedido</h1>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Detalhes do Pedido</h4>
                        <small>Pedido realizado em: <?= $pedido['data_pedido'] ?></small>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Informações Básicas</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Consumo:</strong>
                                        <span><?= formatarNome($pedido['consumo']) ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Pão:</strong>
                                        <span><?= formatarNome($pedido['pao']) ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Proteína:</strong>
                                        <span><?= formatarNome($pedido['proteina']) ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Queijo:</strong>
                                        <span><?= formatarNome($pedido['queijo']) ?></span>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="col-md-6">
                                <h5>Adicionais</h5>
                                
                                <div class="mb-3">
                                    <strong>Vegetais:</strong>
                                    <?php if (!empty($pedido['vegetais'])): ?>
                                        <ul class="list-unstyled ms-3">
                                            <?php foreach ($pedido['vegetais'] as $vegetal): ?>
                                                <li>• <?= formatarNome($vegetal) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        <span class="text-muted">Nenhum vegetal selecionado</span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Molhos:</strong>
                                    <?php if (!empty($pedido['molhos'])): ?>
                                        <ul class="list-unstyled ms-3">
                                            <?php foreach ($pedido['molhos'] as $molho): ?>
                                                <li>• <?= formatarNome($molho) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        <span class="text-muted">Nenhum molho selecionado</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <h5 class="alert-heading">Forma de Pagamento</h5>
                                    <p class="mb-0">
                                        <i class="bi bi-credit-card"></i>
                                        <?= formatarNome($pedido['pagamento']) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="index.php" class="btn btn-secondary me-2">Fazer Novo Pedido</a>
                            <button class="btn btn-success" onclick="confirmarPedido()">Confirmar Pedido</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmação -->
    <div class="modal fade" id="modalConfirmacao" tabindex="-1" aria-labelledby="modalConfirmacaoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalConfirmacaoLabel">Pedido Confirmado!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                        <h4 class="mt-3">Obrigado pelo seu pedido!</h4>
                        <p>Seu sanduíche está sendo preparado com carinho.</p>
                        <?php if ($pedido['consumo'] == 'levar'): ?>
                            <p><strong>Tempo estimado:</strong> 15-20 minutos para retirada</p>
                        <?php else: ?>
                            <p><strong>Tempo estimado:</strong> 10-15 minutos para servir na mesa</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    
    <script>
        function confirmarPedido() {
            var modal = new bootstrap.Modal(document.getElementById('modalConfirmacao'));
            modal.show();
        }
    </script>
</body>
</html>

