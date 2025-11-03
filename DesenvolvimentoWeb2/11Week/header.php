<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: entrada.php");
    exit;
}
?>
<nav style="background:#222;padding:10px;color:white;">
  <a href="submissoes.php" style="color:white;margin-right:15px;">Submissões</a>
  <a href="atividades.php" style="color:white;margin-right:15px;">Atividades</a>
  <a href="envia_submissao.php" style="color:white;margin-right:15px;">Enviar Texto</a>
  <a href="envia_atividade.php" style="color:white;margin-right:15px;">Nova Atividade</a>
  <span style="float:right;">👤 <?php echo $_SESSION['usuario']; ?> | <a href="logout.php" style="color:tomato;">Sair</a></span>
</nav>
