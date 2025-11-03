<?php 
include 'config.php'; 
require_login(); // Garante que o usuário está logado
include 'header.php'; 
?>

<h2>Criar Atividade</h2>

<div class="card">
    <div class="card-body">
        <form action="salva_atividade.php" method="POST">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" id="titulo" name="titulo" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="comentario" class="form-label">Comentário:</label>
                <textarea id="comentario" name="comentario" class="form-control" rows="4"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Publicar</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>