<?php
require_once 'aluno.php';

session_start();

if (isset($_SESSION['aluno'])) {
    $aluno = unserialize($_SESSION['aluno']);
} else {
    header('Location: formulario.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title mb-0">Dados do Aluno</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <strong>Nome:</strong>
                            </div>
                            <div class="col-sm-9">
                                <?php echo htmlspecialchars($aluno->nome); ?>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <strong>Data de Nascimento:</strong>
                            </div>
                            <div class="col-sm-9">
                                <?php echo date('d/m/Y', strtotime($aluno->nascimento)); ?>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <strong>Curso:</strong>
                            </div>
                            <div class="col-sm-9">
                                <?php echo htmlspecialchars($aluno->curso); ?>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <strong>Matrícula:</strong>
                            </div>
                            <div class="col-sm-9">
                                <?php echo htmlspecialchars($aluno->matricula); ?>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <strong>Idade:</strong>
                            </div>
                            <div class="col-sm-9">
                                <?php echo $aluno->idade(); ?> anos
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="mostra_idade.php" class="btn btn-info">Ver Idade</a>
                            <a href="formulario.php" class="btn btn-secondary">Novo Cadastro</a>
                            <a href="sair.php" class="btn btn-danger">Sair</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

