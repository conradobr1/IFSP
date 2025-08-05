<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício Juros Simples</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <h2>Exercício de Juros Simples</h2>
        <form method="GET" class="mb-4">
            <div class="mb-3">
                <label for="capital" class="form-label">Capital (R$):</label>
                <input type="number" name="capital" id="capital" class="form-control" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="taxa" class="form-label">Taxa de Juros (%):</label>
                <input type="number" name="taxa" id="taxa" class="form-control" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="tempo" class="form-label">Tempo (anos):</label>
                <input type="number" name="tempo" id="tempo" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Calcular Juros</button>
        </form>

        <?php
        if (isset($_GET['capital']) && isset($_GET['taxa']) && isset($_GET['tempo'])) {
            $capital = $_GET['capital'];
            $taxa = $_GET['taxa'] / 100;  
            $tempo = $_GET['tempo'];

            echo "<h3>Tabela de Juros Simples</h3>";
            echo "<table class='table table-bordered'>";
            echo "<thead><tr><th>Tempo (anos)</th><th>Montante (R$)</th><th>Juro (R$)</th></tr></thead><tbody>";

            for ($t = 0; $t <= $tempo; $t++) {
                $juro = $capital * $taxa * $t;
                $montante = $capital + $juro;
                echo "<tr><td>$t</td><td>R$ " . number_format($montante, 2, ',', '.') . "</td><td>R$ " . number_format($juro, 2, ',', '.') . "</td></tr>";
            }

            echo "</tbody></table>";
        }
        ?>
    </div>

  
    
</body>
</html>
