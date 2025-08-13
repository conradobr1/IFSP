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
    <title>Idade do Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header bg-info text-white">
                        <h4 class="card-title mb-0">Idade do Aluno</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <h2 class="mb-0">
                                <?php echo htmlspecialchars($aluno->nome) . ", " . $aluno->idade() . " anos"; ?>
                            </h2>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="mostra.php" class="btn btn-primary">Ver Todos os Dados</a>
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

