<?php
include '../modelo/conversor.class.php';

$conv = new Conversor();

$conv->setIdade(2);

echo "<p>Idade: ".$conv->getIdade().
"<br> Idade em Mêses: ".$conv->calcularIdadeMeses().
"<br> Idade em Semanas: ".$conv->calcularIdadeSemanas().
"<br> Idade em Horas: ".$conv->calcularIdadeHoras().
"<br> Idade em Minutos: ".$conv->calcularIdadeMinutos().
"<br> Idade em Segundos: ".$conv->calcularIdadeSegundos()."</p>";
