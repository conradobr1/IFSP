<?php 
include 'config.php'; 

// Se já estiver logado, redireciona para a home
if (isset($_SESSION['usuario_id'])) {
    header("Location: submissoes.php");
    exit;
}

include 'header.php'; 
?>

<div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="text-center mb-4">Entrar</h2>

                <?php
                // Exibe a mensagem de erro, se houver
                if (isset($_SESSION['login_error'])) {
                    echo '<div class="alert alert-danger">' . $_SESSION['login_error'] . '</div>';
                    unset($_SESSION['login_error']); // Limpa o erro
                }
                ?>

                <form action="busca_usuario.php" method="POST">
                    <div class="mb-3">
                        <label for="login" class="form-label">Usuário ou E-mail:</label>
                        <input type="text" id="login" name="login" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha:</label>
                        <input type="password" id="senha" name="senha" class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">Entrar</button>
                    </div>
                </form>

                <p class="text-center mt-3">
                    Não tem conta? <a href="cadastro_usuario.php">Cadastre-se</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>