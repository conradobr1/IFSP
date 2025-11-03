<?php 
include 'config.php'; 
require_login();
include 'header.php'; 
?>

<h2 class="mb-4">Meus Textos Enviados</h2>

<?php
// Consulta avançada que busca submissões e JÁ CALCULA as avaliações
$stmt = $pdo->prepare("
    SELECT 
        s.*, 
        COUNT(a.id) AS total_avaliacoes,
        SUM(CASE WHEN a.aprovado = 1 THEN 1 ELSE 0 END) AS aprovacoes,
        SUM(CASE WHEN a.aprovado = 0 THEN 1 ELSE 0 END) AS reprovacoes
    FROM 
        submissoes s
    LEFT JOIN 
        avaliacoes a ON s.id = a.submissao_id
    WHERE 
        s.usuario_id = ?
    GROUP BY 
        s.id
    ORDER BY 
        s.data_submissao DESC
");
$stmt->execute([$_SESSION['usuario_id']]);
$submissoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($submissoes) == 0) {
    echo "<div class='alert alert-info'>Você ainda não enviou nenhum texto.</div>";
} else {
    foreach ($submissoes as $s) {
        
        $status_label = '';
        $status_class = '';

        // Lógica para definir o status
        if ($s['total_avaliacoes'] == 0) {
            $status_label = 'Pendente';
            $status_class = 'bg-secondary';
        } elseif ($s['aprovacoes'] > $s['reprovacoes']) {
            $status_label = 'Aprovado';
            $status_class = 'bg-success';
        } else {
            $status_label = 'Reprovado (ou empatado)';
            $status_class = 'bg-danger';
        }
?>
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title mb-1"><?= htmlspecialchars($s['titulo']) ?></h5>
                        <p class="card-text text-muted small">
                            Enviado em: <?= date('d/m/Y', strtotime($s['data_submissao'])) ?>
                        </p>
                    </div>
                    <!-- A "Pastilha" de Status -->
                    <span class="badge <?= $status_class ?> fs-6"><?= $status_label ?></span>
                </div>
                
                <p class="mt-2">
                    <span class="text-success"><?= $s['aprovacoes'] ?> Votos (Aprovar)</span> | 
                    <span class="text-danger"><?= $s['reprovacoes'] ?> Votos (Reprovar)</span>
                </p>

                <a href="visualiza_submissao.php?id=<?= $s['id'] ?>" class="btn btn-outline-primary btn-sm">
                    Ver Detalhes e Comentários
                </a>
            </div>
        </div>
<?php
    }
}
?>

<?php include 'footer.php'; ?>