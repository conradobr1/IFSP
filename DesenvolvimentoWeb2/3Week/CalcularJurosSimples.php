<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Juros Simples</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h4 mb-0 text-center">Calculadora de Juros Simples</h1>
                    </div>             <div class="card-body">
                        <form id="formJuros">
                            <div class="mb-3">
                                <label for="capital" class="form-label">Capital Inicial (R$)</label>
                                <input type="number" class="form-control" id="capital" placeholder="Ex: 1000" required>
                            </div>
                            <div class="mb-3">
                                <label for="taxa" class="form-label">Taxa de Juros (% ao mês)</label>
                                <input type="number" class="form-control" id="taxa" placeholder="Ex: 5" required>
                            </div>
                            <div class="mb-3">
                                <label for="tempo" class="form-label">Tempo (meses)</label>
                                <input type="number" class="form-control" id="tempo" placeholder="Ex: 12" required>
                            </div>
                            <button type="button" class="btn btn-primary w-100" onclick="calcular()">
                                Calcular Juros
                            </button>
                        </form>
                        
                        <div id="resultado" class="mt-4 alert alert-success d-none">
                            <h4 class="alert-heading">Resultado</h4>
                            <p id="valorJuros" class="mb-0"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function calcularJurosSimples(capital, taxa, tempo) {
            return capital * (taxa / 100) * tempo;
        }
//Conrado
        function calcular() {
          
            const capital = parseFloat(document.getElementById('capital').value);
            const taxa = parseFloat(document.getElementById('taxa').value);
            const tempo = parseFloat(document.getElementById('tempo').value);


            if (isNaN(capital) || isNaN(taxa) || isNaN(tempo)) {
                alert("Por favor, preencha todos os campos com valores válidos!");
                return;
            }

        
            const juros = calcularJurosSimples(capital, taxa, tempo);

            const resultadoDiv = document.getElementById('resultado');
            document.getElementById('valorJuros').textContent = 
                `Juros: R$ ${juros.toFixed(2)} | Total: R$ ${(capital + juros).toFixed(2)}`;
            
            resultadoDiv.classList.remove('d-none');
        }
    </script>
</body>
</html>