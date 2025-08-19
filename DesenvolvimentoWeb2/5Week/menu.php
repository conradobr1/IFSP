<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <?php if( $pagina_atual == 'home' ): ?>
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          <?php else: ?>
            <a class="nav-link" href="home.php">Home</a>
          <?php endif; ?>
        </li>
        <li class="nav-item">
          <?php if( $pagina_atual == 'texto' ): ?>
          <a class="nav-link active" aria-current="page" href="envia_texto.php">Texto</a>
          <?php else: ?>
            <a class="nav-link" href="envia_texto.php">Texto</a>
          <?php endif; ?>
        </li>
        <li class="nav-item">
          <?php if( $pagina_atual == 'tipo' ): ?>
          <a class="nav-link active" aria-current="page" href="envia_tipo.php">Tipo</a>
          <?php else: ?>
            <a class="nav-link" href="envia_tipo.php">Tipo</a>
          <?php endif; ?>
        </li>
        <li class="nav-item">
          <?php if( $pagina_atual == 'cor' ): ?>
          <a class="nav-link active" aria-current="page" href="envia_cor.php">Cor</a>
          <?php else: ?>
            <a class="nav-link" href="envia_cor.php">Cor</a>
          <?php endif; ?>
        </li>
        <li class="nav-item">
          <?php if( $pagina_atual == 'exibir' ): ?>
          <a class="nav-link active" aria-current="page" href="mostra_texto.php">Exibir</a>
          <?php else: ?>
            <a class="nav-link" href="mostra_texto.php">Exibir</a>
          <?php endif; ?>
        </li>
        <li class="nav-item">
          <?php if( $pagina_atual == 'sair' ): ?>
          <a class="nav-link active" aria-current="page" href="sair.php">Sair</a>
          <?php else: ?>
            <a class="nav-link" href="sair.php">Sair</a>
          <?php endif; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>