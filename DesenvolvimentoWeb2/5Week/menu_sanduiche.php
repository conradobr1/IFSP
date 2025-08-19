<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Sanduicheria</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <?php if( $pagina_atual == 'pedido' ): ?>
          <a class="nav-link active" aria-current="page" href="index.php">Fazer Pedido</a>
          <?php else: ?>
            <a class="nav-link" href="index.php">Fazer Pedido</a>
          <?php endif; ?>
        </li>
        <li class="nav-item">
          <?php if( $pagina_atual == 'resumo' ): ?>
          <a class="nav-link active" aria-current="page" href="resumo_pedido.php">Resumo do Pedido</a>
          <?php else: ?>
            <a class="nav-link" href="resumo_pedido.php">Resumo do Pedido</a>
          <?php endif; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>

