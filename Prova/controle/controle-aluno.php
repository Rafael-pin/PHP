<?php
include '../modelo/aluno.class.php';

$aluno = new Aluno();

$aluno->setNome($_POST['txtnome']);
$aluno->setSobrenome($_POST['txtsobrenome']);
$aluno->setSexo($_POST['sexo']);
$aluno->setEstadoCivil($_POST['estadocivil']);
$aluno->setN1($_POST['numn1']);
$aluno->setP1($_POST['nump1']);
$aluno->setN2($_POST['numn2']);
$aluno->setP2($_POST['nump2']);
$aluno->setPresenca($_POST['numpresenca']);
$aluno->setTotalAulas($_POST['numaulas']);

// echo "<p>Nome: ".$aluno->getNome().
//      "<br>Sobrenome: ".$aluno->getSobrenome().
//      "<br>Sexo: ".$aluno->getSexo().
//      "<br>Estado civil: ".$aluno->getEstadoCivil().
//      "<br>Nota 1: ".$aluno->getN1().
//      "<br>Peso 1: ".$aluno->getP1().
//      "<br>Nota 2: ".$aluno->getN2().
//      "<br>Peso 2: ".$aluno->getP2().
//      "<br>Presença: ".$aluno->getPresenca().
//      "<br>Total de aulas: ".$aluno->getTotalAulas()."</p>";

header("location:../resposta.php?n1={$aluno->getN1()}&p1={$aluno->getP1()}&n2={$aluno->getN2()}&p2={$aluno->getP2()}&presenca={$aluno->getPresenca()}&aulas={$aluno->getTotalAulas()}&freq={$aluno->calcularFrequencia()}&mari={$aluno->calcularMediaAritmetica()}&mpon={$aluno->calcularMediaPonderada()}&apr={$aluno->verificarAprovacao()}&con={$aluno->verificarConceito()}");
