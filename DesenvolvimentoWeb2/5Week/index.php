<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido de Sanduíche</title>
    <!-- CSS do Bootstrap: -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
    <!-- incluir menu.php -->
    <?php
    $pagina_atual = 'pedido';
    include 'menu_sanduiche.php';
    ?>
    
    <div class="container mt-4">
        <h1 class="text-center mb-4">Faça seu Pedido de Sanduíche</h1>
        
        <form action="processar_pedido.php" method="POST" id="formPedido">
            <div class="row">
                <div class="col-md-6">
                    <!-- Levar ou comer no local -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Onde vai consumir?</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="consumo" id="levar" value="levar" required>
                                <label class="form-check-label" for="levar">
                                    Levar
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="consumo" id="local" value="local" required>
                                <label class="form-check-label" for="local">
                                    Comer no local
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Tipo de pão -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Tipo de Pão</h5>
                        </div>
                        <div class="card-body">
                            <select class="form-select" name="pao" required>
                                <option value="">Selecione o pão</option>
                                <option value="frances">Pão Francês</option>
                                <option value="integral">Pão Integral</option>
                                <option value="ciabatta">Ciabatta</option>
                                <option value="pita">Pão Pita</option>
                                <option value="baguete">Baguete</option>
                            </select>
                        </div>
                    </div>

                    <!-- Carne ou frango -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Proteína</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="proteina" id="carne" value="carne" required>
                                <label class="form-check-label" for="carne">
                                    Carne
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="proteina" id="frango" value="frango" required>
                                <label class="form-check-label" for="frango">
                                    Frango
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Tipo de queijo -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Tipo de Queijo</h5>
                        </div>
                        <div class="card-body">
                            <select class="form-select" name="queijo" required>
                                <option value="">Selecione o queijo</option>
                                <option value="mussarela">Mussarela</option>
                                <option value="cheddar">Cheddar</option>
                                <option value="prato">Queijo Prato</option>
                                <option value="provolone">Provolone</option>
                                <option value="gorgonzola">Gorgonzola</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Vegetais -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Vegetais (seleção múltipla)</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vegetais[]" id="alface" value="alface">
                                <label class="form-check-label" for="alface">
                                    Alface
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vegetais[]" id="tomate" value="tomate">
                                <label class="form-check-label" for="tomate">
                                    Tomate
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vegetais[]" id="cebola" value="cebola">
                                <label class="form-check-label" for="cebola">
                                    Cebola
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vegetais[]" id="pepino" value="pepino">
                                <label class="form-check-label" for="pepino">
                                    Pepino
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vegetais[]" id="pimentao" value="pimentao">
                                <label class="form-check-label" for="pimentao">
                                    Pimentão
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Molhos -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Molhos (seleção múltipla)</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="molhos[]" id="maionese" value="maionese">
                                <label class="form-check-label" for="maionese">
                                    Maionese
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="molhos[]" id="ketchup" value="ketchup">
                                <label class="form-check-label" for="ketchup">
                                    Ketchup
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="molhos[]" id="mostarda" value="mostarda">
                                <label class="form-check-label" for="mostarda">
                                    Mostarda
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="molhos[]" id="barbecue" value="barbecue">
                                <label class="form-check-label" for="barbecue">
                                    Barbecue
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="molhos[]" id="ranch" value="ranch">
                                <label class="form-check-label" for="ranch">
                                    Ranch
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Pagamento -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Forma de Pagamento</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pagamento" id="pix" value="pix" required>
                                <label class="form-check-label" for="pix">
                                    PIX
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pagamento" id="cartao" value="cartao" required>
                                <label class="form-check-label" for="cartao">
                                    Cartão
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg">Fazer Pedido</button>
            </div>
        </form>
    </div>

    <!-- JS do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>

