<?php 
include 'config.php'; 
include 'header.php'; 
?>

<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="text-center mb-4">Cadastro de Usuário</h2>
                
                <form action="salva_usuario.php" method="POST">
                    <div class="mb-3">
                        <label for="nome_completo" class="form-label">Nome completo:</label>
                        <input type="text" id="nome_completo" name="nome_completo" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuário:</label>
                        <input type="text" id="usuario" name="usuario" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="data_nascimento" class="form-label">Data de nascimento:</label>
                        <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF:</label>
                        <input type="text" id="cpf" name="cpf" class="form-control" maxlength="14" placeholder="000.000.000-00" required>
                    </div>

                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha:</label>
                        <input type="password" id="senha" name="senha" class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Cadastrar</button>
                    </div>
                </form>
                
                <p class="text-center mt-3">
                    Já tem conta? <a href="entrada.php">Entrar</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>