<?php
include '../modelo/cliente.class.php';

$cli=new Cliente ();

$cli->setNome ("Rafael");
$cli->setIdade(17);
$cli->setSexo("Masculino");


echo "<p>";
echo "<br>Nome: ".$cli->getNome();
echo "<br>Idade: ".$cli->getIdade();
echo "<br>Sexo: ".$cli->getSexo();
echo "<br>Verificação: ".$cli->verificarSexo();
echo "<br>Idade em mêses: ".$cli->calcularIdadeMeses();
echo "</p>";
