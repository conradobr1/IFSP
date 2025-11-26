<?php
require 'db.php'; // seu db.php já inicia session_start() e cria $pdo

// Verifica se está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
$user_id = $_SESSION['user_id'];
$msg_feedback = "";

// Ao submeter o formulário de importação
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['conteudo'])) {
    $raw_text = $_POST['conteudo'];

    try {
        // Limpa histórico atual do usuário
        $pdo->prepare("DELETE FROM historico WHERE user_id = ?")->execute([$user_id]);

        $stmtInsert = $pdo->prepare("INSERT INTO historico (user_id, semestre, disciplina, nota, situacao) VALUES (?, ?, ?, ?, ?)");

        $lines = preg_split('/\R/u', $raw_text);
        $count = 0;

        // Regex para as linhas do SUAP
        $linePattern = '~^\s*(\d{4}\/\d+|-)\s+(\d+|-)\s+(\d+|-)\s+SUP\.\d+\s+\(([^)]+)\)\s+(.*?)\s+(\d{1,3},\d{2}|-)\s+(\d{1,3},\d{2}|-)\s+(\d+%|-)\s*(Aprovado|Reprovado|Cursando|-)?\s*$~u';

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' ) continue;

            $lower = mb_strtolower($line, 'UTF-8');
            if (mb_strpos($lower, 'ano letivo') !== false || mb_strpos($lower, 'período do curso') !== false || mb_strpos($lower, 'componentes') !== false || mb_strpos($lower, 'código') !== false || mb_strpos($lower, 'descrição') !== false) {
                continue;
            }

            if (preg_match($linePattern, $line, $m)) {
                $anoPeriodo = $m[1];
                $periodo = $m[2];
                $disciplina = trim($m[5]);
                $notaRaw = $m[7];
                $situacaoRaw = isset($m[9]) ? $m[9] : '-';

                // Normaliza semestre
                if ($anoPeriodo === '-' || trim($anoPeriodo) === '') {
                    $semestre = ($periodo !== '-' && $periodo !== '') ? "Futuro (sem $periodo)" : "Futuro";
                } else {
                    $semestre = $anoPeriodo;
                }

                // Normaliza nota
                $nota = ($notaRaw === '-' || trim($notaRaw) === '') ? null : floatval(str_replace(',', '.', $notaRaw));

                // Normaliza situação
                $situacao = $situacaoRaw;
                if ($situacao === '-' || trim($situacao) === '') {
                    if ($anoPeriodo === '-' || trim($anoPeriodo) === '') {
                        $situacao = "A Cursar";
                    } else {
                        if ($nota !== null) {
                            $situacao = ($nota >= 6.0) ? "Aprovado" : "Reprovado";
                        } else {
                            $situacao = "A Cursar";
                        }
                    }
                }

                $stmtInsert->execute([$user_id, $semestre, $disciplina, $nota, $situacao]);
                $count++;
                continue;
            }

            // Fallback Regex
            $fallback = '~(\d{4}\/\d+|-).*?SUP\.\d+.*?\(([^)]+)\)\s+(.*?)\s+(\d{1,3},\d{2}|-)\s+(\d{1,3},\d{2}|-).*?(Aprovado|Reprovado|Cursando|-)?~u';
            if (preg_match($fallback, $line, $f)) {
                $anoPeriodo = $f[1];
                $disciplina = trim($f[3]);
                $notaRaw = $f[5];
                $situacaoRaw = isset($f[6]) ? $f[6] : '-';

                $semestre = ($anoPeriodo === '-' ? "Futuro" : $anoPeriodo);
                $nota = ($notaRaw === '-' ? null : floatval(str_replace(',', '.', $notaRaw)));
                $situacao = ($situacaoRaw === '-' ? ($nota === null ? "A Cursar" : ($nota >= 6.0 ? "Aprovado" : "Reprovado")) : $situacaoRaw);

                $stmtInsert->execute([$user_id, $semestre, $disciplina, $nota, $situacao]);
                $count++;
            }
        }
        $msg_feedback = "Importado: {$count} disciplinas.";
    } catch (PDOException $e) {
        $msg_feedback = "Erro ao processar: " . $e->getMessage();
    }
}

// --- Consulta para exibir o histórico ---
$stmtAll = $pdo->prepare("SELECT * FROM historico WHERE user_id = ? ORDER BY semestre ASC, disciplina ASC");
$stmtAll->execute([$user_id]);
$historico = $stmtAll->fetchAll(PDO::FETCH_ASSOC);

// =================================================================
// CÁLCULOS ESTATÍSTICOS (Média, Maior, Menor)
// =================================================================
$soma_notas = 0;
$qtd_notas = 0;
$maior_nota = null;
$menor_nota = null;

foreach ($historico as $h) {
    // Só calcula se a nota não for nula (ignora "A Cursar" ou "Cursando" sem nota)
    if ($h['nota'] !== null) {
        $valor = (float)$h['nota'];
        
        $soma_notas += $valor;
        $qtd_notas++;

        // Verifica maior nota
        if ($maior_nota === null || $valor > $maior_nota) {
            $maior_nota = $valor;
        }

        // Verifica menor nota
        if ($menor_nota === null || $valor < $menor_nota) {
            $menor_nota = $valor;
        }
    }
}

// Calcula a média final
$media_geral = ($qtd_notas > 0) ? ($soma_notas / $qtd_notas) : 0;
// =================================================================

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Painel Acadêmico</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; max-width: 1000px; margin: auto; padding: 20px; background:#f6f7fb; }
        .badge-aprovado { background:#28a745; color:#fff; padding:6px 8px; border-radius:6px; }
        .badge-reprovado { background:#dc3545; color:#fff; padding:6px 8px; border-radius:6px; }
        .badge-cursando { background:#ffc107; color:#222; padding:6px 8px; border-radius:6px; }
        .badge-acursar { background:#6c757d; color:#fff; padding:6px 8px; border-radius:6px; }
        /* Estilo para os cards de estatísticas */
        .stat-card { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.2s; }
        .stat-card:hover { transform: translateY(-5px); }
        .stat-icon { font-size: 2rem; opacity: 0.3; position: absolute; right: 15px; top: 15px; }
    </style>
</head>
<body>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📊 Painel Acadêmico</h2>
        <a href="index.php" class="btn btn-outline-danger">Sair</a>
    </div>

    <?php if ($msg_feedback): ?>
        <div class="alert alert-info"><?= htmlspecialchars($msg_feedback) ?></div>
    <?php endif; ?>

    <?php if ($qtd_notas > 0): ?>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card stat-card bg-primary text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title">Média Geral</h5>
                    <h2 class="fw-bold"><?= number_format($media_geral, 2, ',', '.') ?></h2>
                    <p class="card-text small">Baseado em <?= $qtd_notas ?> disciplinas com nota</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card bg-success text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title">Maior Nota</h5>
                    <h2 class="fw-bold"><?= number_format($maior_nota, 2, ',', '.') ?></h2>
                    <p class="card-text small">Melhor desempenho</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card bg-danger text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title">Menor Nota</h5>
                    <h2 class="fw-bold"><?= number_format($menor_nota, 2, ',', '.') ?></h2>
                    <p class="card-text small">Ponto de atenção</p>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header bg-white fw-bold">Importar Histórico</div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-2">
                    <label class="form-label text-muted small">Copie a tabela do SUAP (Ctrl+A no histórico e copie) e cole abaixo:</label>
                    <textarea name="conteudo" class="form-control" rows="5" placeholder="Ano Letivo ... Componentes ... Nota ..."><?= isset($_POST['conteudo']) ? htmlspecialchars($_POST['conteudo']) : '' ?></textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Processar Dados</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-white fw-bold">Disciplinas</div>
        <div class="card-body p-0">
            <?php if (count($historico) === 0): ?>
                <p class="m-4 text-center text-muted">Nenhuma disciplina encontrada. Use a caixa acima para importar.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle m-0">
                        <thead class="table-light">
                            <tr>
                                <th>Semestre</th>
                                <th>Disciplina</th>
                                <th>Nota</th>
                                <th>Situação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($historico as $h): 
                                $classe = '';
                                $sit = mb_strtolower($h['situacao']);
                                if ($sit === 'aprovado') $classe = 'badge-aprovado';
                                elseif ($sit === 'reprovado') $classe = 'badge-reprovado';
                                elseif ($sit === 'cursando') $classe = 'badge-cursando';
                                else $classe = 'badge-acursar';
                            ?>
                                <tr>
                                    <td class="fw-bold text-secondary"><?= htmlspecialchars($h['semestre']) ?></td>
                                    <td><?= htmlspecialchars($h['disciplina']) ?></td>
                                    <td class="fw-bold">
                                        <?= ($h['nota'] === null) ? '--' : number_format($h['nota'], 2, ',', '.') ?>
                                    </td>
                                    <td><span class="<?= $classe ?>"><?= htmlspecialchars($h['situacao']) ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>