<?php
include_once 'dao/funcionariodao.class.php';
include_once 'modelo/funcionario.class.php';

$funcDAO = new FuncionarioDAO();

if(isset($_GET['id'])){
  echo $funcDAO->gerarJSON("codigo",$_GET['id']);
}else{
  echo $funcDAO->gerarJSON("","");
}
 ?>
