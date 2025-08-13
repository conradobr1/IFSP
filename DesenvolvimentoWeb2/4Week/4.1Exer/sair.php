<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saindo do Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="refresh" content="3;url=formulario.php">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header bg-success text-white">
                        <h4 class="card-title mb-0">Logout Realizado</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success">
                            <h5>Sessão encerrada com sucesso!</h5>
                            <p class="mb-0">Você será redirecionado para a página de cadastro em 3 segundos...</p>
                        </div>
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Carregando...</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="formulario.php" class="btn btn-primary">Ir para Cadastro Agora</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

