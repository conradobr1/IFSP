<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparação de Números</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Comparação de Números em PHP</h2>
        <form action="Exer4.php" method="GET">
            <div class="mb-3">
                <label for="num1" class="form-label">Número 1:</label>
                <input type="number" name="num1" id="num1" class="form-control" step="any" value="<?php echo isset($x) ? $x : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="num2" class="form-label">Número 2:</label>
                <input type="number" name="num2" id="num2" class="form-control" step="any" value="<?php echo isset($y) ? $y : ''; ?>" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Comparar</button>
        </form>
    </div>

    <!-- Conrado -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb2hbDA8GO9YvFqY3k7I4m8uHf7re5zzV2zv2+z12f+bQ6Ojq" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0jLFf3fi0dP5m+rF6I5a9xzau2CwWlefbMkjxC9nPrJ9sq+J" crossorigin="anonymous"></script>
</body>
</html>
