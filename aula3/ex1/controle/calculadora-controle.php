<?php
include '../modelo/calculadora.php';

$calc = new Calculadora();

$calc->setNum1(2);
$calc->setNum2(2);

echo "<p>Número 1: ".$calc->getNum1().
"<br>Número 2: ".$calc->getNum2().
"<br>Soma: ".$calc->somar().
"<br>Subtração: ".$calc->subtrair().
"<br>Divisão: ".$calc->dividir().
"<br>Multiplicação: ".$calc->multiplicar()."</p>";
