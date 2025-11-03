<?php
require 'config.php';
require_login();
include 'header.php';

// 1. Pega o ID da submissão pela URL
$id = $_GET['id'] ?? null;
if (!$id) {
    echo "<div class='alert alert-danger'>ID da submissão não informado.</div>";
    include 'footer.php';
    exit;
}

// 2. Busca a submissão (SEM verificar o dono)
$stmt = $pdo->prepare("
    SELECT s.*, u.usuario 
    FROM submissoes s
    JOIN usuarios u ON s.usuario_id = u.id
    WHERE s.id = ?
");
$stmt->execute([$id]); // Removemos o $_SESSION['usuario_id']
$sub = $stmt->fetch(PDO::FETCH_ASSOC);

// 3. Se não achou, mostra mensagem
if (!$sub) {
    echo "<div class='alert alert-danger'>Submissão não encontrada.</div>";
    include 'footer.php';
    exit;
}
?>

<h3 class="mb-3">Detalhes da Submissão: <?= htmlspecialchars($sub['titulo']) ?></h3>

<div class="card mb-4">
  <div class="card-body">
    <p><strong>Autor:</strong> <?= htmlspecialchars($sub['usuario']) ?></p>
    <p><strong>Observações:</strong></p>
    <p><?= nl2br(htmlspecialchars($sub['observacoes'])) ?></p>
    <a href="uploads/<?= htmlspecialchars($sub['arquivo']) ?>" class="btn btn-outline-secondary" target="_blank">
      Ver Arquivo Enviado
    </a>
  </div>
</div>

<h4 class="mb-3">Avaliações Recebidas:</h4>

<?php
// 4. Busca as avaliações dessa submissão
$stmt = $pdo->prepare("
    SELECT a.*, u.usuario 
    FROM avaliacoes a 
    JOIN usuarios u ON a.usuario_id = u.id
    WHERE a.submissao_id = ?
    ORDER BY a.data_avaliacao DESC
");
$stmt->execute([$id]);
$avaliacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($avaliacoes) == 0) {
    echo "<p class='text-muted'>Nenhuma avaliação ainda.</p>";
} else {
    foreach ($avaliacoes as $a) {
        
        // Define o status e a cor
        if ($a['aprovado']) {
            $status_label = '✅ Aprovado';
            $status_class = 'text-success';
        } else {
            $status_label = '❌ Reprovado';
            $status_class = 'text-danger';
        }
?>
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                <strong>Avaliador: <?= htmlspecialchars($a['usuario']) ?></strong>
                <strong class="<?= $status_class ?>"><?= $status_label ?></strong>
            </div>
            <div class="card-body">
                <p class="card-text fst-italic">"<?= nl2br(htmlspecialchars($a['comentario'])) ?>"</p>
            </div>
        </div>
<?php
    }
}

include 'footer.php';
?>