<?php
$pagina_atual = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="formulario.php">Sistema de Alunos</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($pagina_atual == 'formulario.php') ? 'active' : ''; ?>" href="formulario.php">Cadastrar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($pagina_atual == 'mostra.php') ? 'active' : ''; ?>" href="mostra.php">Mostrar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($pagina_atual == 'mostra_idade.php') ? 'active' : ''; ?>" href="mostra_idade.php">Idade</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sair.php">Sair</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

