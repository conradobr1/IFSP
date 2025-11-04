<?php
// Método compatível (que funciona para si) para iniciar a sessão
if (session_id() === '') {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clube de Escrita</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="submissoes.php">✍️ Clube de Escrita</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menuPrincipal">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="menuUsuarios" role="button" data-bs-toggle="dropdown">
            Usuários
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="cadastro_usuario.php">Cadastro</a></li>
            <li><a class="dropdown-item" href="entrada.php">Login</a></li>
          </ul>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="menuSubmissoes" role="button" data-bs-toggle="dropdown">
            Submissões
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="envia_submissao.php">Enviar Texto</a></li>
            <li><a class="dropdown-item" href="submissoes.php">Ver/Avaliar Textos</a></li>
            <li><a class="dropdown-item" href="minhas_submissoes.php">Meus Textos Enviados</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="visualiza_submissao.php">Visualizar Todas</a></li> </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="menuAtividades" role="button" data-bs-toggle="dropdown">
            Atividades
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="envia_atividade.php">Criar Atividade</a></li>
            <li><a class="dropdown-item" href="atividades.php">Ver Atividades</a></li>
            <li><a class="dropdown-item" href="minhas_atividades.php">Minhas Atividades</a></li>
          </ul>
        </li>
      </ul>
      
      <div class="d-flex">
        <?php if (isset($_SESSION['usuario'])): ?>
          <span class="navbar-text text-white me-3">
            👤 <?= htmlspecialchars($_SESSION['usuario']); ?>
          </span>
          <a href="logout.php" class="btn btn-outline-light btn-sm">Sair</a>
        <?php else: ?>
          <a href="cadastro_usuario.php" class="btn btn-outline-light btn-sm me-2">Cadastrar</a>
          <a href="entrada.php" class="btn btn-primary btn-sm">Entrar</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<div class="container">