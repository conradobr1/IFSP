<?php 
include 'config.php'; 
require_login(); // Garante que o usuário está logado
include 'header.php'; 
?>

<h2>Enviar Submissão</h2>

<div class="card">
    <div class="card-body">
        <form action="salva_submissao.php" method="POST" enctype="multipart/form-data">
            
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" id="titulo" name="titulo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="observacoes" class="form-label">Observações:</label>
                <textarea id="observacoes" name="observacoes" class="form-control" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label for="arquivo" class="form-label">Arquivo (PDF ou TXT):</label>
                <input type="file" id="arquivo" name="arquivo" class="form-control" accept=".pdf,.txt" required>
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>