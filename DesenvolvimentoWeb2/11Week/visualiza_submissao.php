<?php
require 'config.php';
require_login();
include 'header.php';

// Verificamos se um ID foi passado na URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    // ############ MODO 1: MOSTRAR DETALHES (pois temos um ID) ############
    // (Esta parte não muda)
    
    $id = $_GET['id'];
    
    // 1. Busca a submissão específica
    $stmt = $pdo->prepare("
        SELECT s.*, u.usuario 
        FROM submissoes s
        JOIN usuarios u ON s.usuario_id = u.id
        WHERE s.id = ?
    ");
    $stmt->execute([$id]);
    $sub = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$sub) {
        echo "<div class='alert alert-danger'>Submissão não encontrada.</div>";
    } else {
?>
        <h3 class="mb-3">Detalhes da Submissão: <?= htmlspecialchars($sub['titulo']) ?></h3>
        <div class="card mb-4">
          <div class="card-body">
            <p><strong>Autor:</strong> <?= htmlspecialchars($sub['usuario']) ?></p>
            <p><strong>Observações:</strong> <?= nl2br(htmlspecialchars($sub['observacoes'])) ?></p>
            <a href="uploads/<?= htmlspecialchars($sub['arquivo']) ?>" class="btn btn-outline-secondary" target="_blank">
              Ver Arquivo Enviado
            </a>
          </div>
        </div>

        <h4 class="mb-3">Avaliações Recebidas:</h4>
<?php
        // 2. Busca as avaliações dessa submissão
        $stmt_aval = $pdo->prepare("
            SELECT a.*, u.usuario 
            FROM avaliacoes a 
            JOIN usuarios u ON a.usuario_id = u.id
            WHERE a.submissao_id = ?
            ORDER BY a.data_avaliacao DESC
        ");
        $stmt_aval->execute([$id]);
        $avaliacoes = $stmt_aval->fetchAll(PDO::FETCH_ASSOC);

        if (count($avaliacoes) == 0) {
            echo "<p class='text-muted'>Nenhuma avaliação ainda.</p>";
        } else {
            foreach ($avaliacoes as $a) {
                $status_label = $a['aprovado'] ? '✅ Aprovado' : '❌ Reprovado';
                $status_class = $a['aprovado'] ? 'text-success' : 'text-danger';
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
            } // fim do foreach avaliacoes
        } // fim do else (tem avaliacoes)
    } // fim do else (submissao encontrada)

} else {
    
    // ############ MODO 2: MOSTRAR LISTA (pois NÃO temos um ID) ############
    // (Esta é a parte que foi CORRIGIDA)
    
?>
    <h2 class="mb-4">Visualizar Todas as Submissões</h2>
    <p>Lista de todas as submissões e seus status. Clique para ver os detalhes.</p>
<?php
    // A NOVA QUERY (igual à de minhas_submissoes, mas para TODOS os usuários)
    $sql = $pdo->query("
        SELECT 
            s.*, 
            u.usuario,
            COUNT(a.id) AS total_avaliacoes,
            SUM(CASE WHEN a.aprovado = 1 THEN 1 ELSE 0 END) AS aprovacoes,
            SUM(CASE WHEN a.aprovado = 0 THEN 1 ELSE 0 END) AS reprovacoes
        FROM 
            submissoes s
        JOIN 
            usuarios u ON s.usuario_id = u.id
        LEFT JOIN 
            avaliacoes a ON s.id = a.submissao_id
        GROUP BY 
            s.id, u.usuario -- Agrupamos pelo ID e nome do usuário
        ORDER BY 
            s.data_submissao DESC
    ");

    if ($sql->rowCount() == 0) {
        echo "<div class='alert alert-info'>Nenhuma submissão encontrada.</div>";
    } else {
        
        // O NOVO LOOP (igual ao de minhas_submissoes)
        foreach($sql as $s) {
            
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
                                Enviado por: <?= htmlspecialchars($s['usuario']) ?>
                            </p>
                        </div>
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
        } // fim do foreach submissoes
    } // fim do else (tem submissoes)
} // fim do else (nenhum ID foi passado)

include 'footer.php';
?>