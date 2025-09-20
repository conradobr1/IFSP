<?php
session_start();
if(!isset($_SESSION["id"])){header("Location: login.php");exit;}
$pdo=new PDO("mysql:host=localhost;dbname=ctsite","root","");
$stmt=$pdo->prepare("SELECT * FROM tarefas WHERE usuario_id=? AND data_limite<=CURDATE()");
$stmt->execute([$_SESSION["id"]]);
$tarefas=$stmt->fetchAll();
$hoje=date("Y-m-d");
?>
<h2>Tarefas de <?=$_SESSION["nome"]?></h2>
<ul>
<?php foreach($tarefas as $t): ?>
<li style="color:<?=($t["data_limite"]==$hoje?"red":"black")?>">
<?=$t["nome_tarefa"]?> - <?=$t["data_limite"]?>
</li>
<?php endforeach; ?>
</ul>
<a href="add_tarefa.php">Adicionar tarefa</a><br>
<a href="logout.php">Sair</a>
