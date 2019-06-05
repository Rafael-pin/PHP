<?php
session_start();
include '../modelo/pessoa.class.php';
include '../util/validacao.class.php';

$qtd = 0;

if(!Validacao::validarNome($_POST['txtnome'])){
  $_SESSION["erro"] = "Nome inválido!";
  header("location:../cadastro-pessoa.php");
  $qtd++;
}

if($qtd == 0){
  $p = new Pessoa();
  $p->nome = $_POST['txtnome'];
  $_SESSION['msg'] = "Pessoa cadastrada com sucesso!";
  $_SESSION['pessoa'] = serialize($p);
  header("location:../resposta.php");
  echo $p;
  $p->__destruct();
}
