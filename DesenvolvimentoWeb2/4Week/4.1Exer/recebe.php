<?php
require_once 'aluno.php';

if ($_POST) {
    $nome = $_POST['nome'];
    $nascimento = $_POST['nascimento'];
    $curso = $_POST['curso'];
    $matricula = $_POST['matricula'];
    
    $aluno = new Aluno($nome, $nascimento, $curso, $matricula);
    $alunoSerializado = serialize($aluno);
    
    session_start();
    $_SESSION['aluno'] = $alunoSerializado;
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
    <title>Dados Recebidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-success text-center">
                    <h4>Aluno cadastrado com sucesso!</h4>
                    <p>Os dados foram salvos na sessão.</p>
                </div>
                
                <div class="text-center">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dadosModal">
                        Mostrar Dados
                    </button>
                    <a href="formulario.php" class="btn btn-secondary">Novo Cadastro</a>
                    <a href="mostra.php" class="btn btn-info">Ver Página de Dados</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dadosModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dados do Aluno Cadastrado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Nome:</th>
                            <td><?php echo htmlspecialchars($aluno->nome); ?></td>
                        </tr>
                        <tr>
                            <th>Data de Nascimento:</th>
                            <td><?php echo date('d/m/Y', strtotime($aluno->nascimento)); ?></td>
                        </tr>
                        <tr>
                            <th>Curso:</th>
                            <td><?php echo htmlspecialchars($aluno->curso); ?></td>
                        </tr>
                        <tr>
                            <th>Matrícula:</th>
                            <td><?php echo htmlspecialchars($aluno->matricula); ?></td>
                        </tr>
                        <tr>
                            <th>Idade:</th>
                            <td><?php echo $aluno->idade(); ?> anos</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

