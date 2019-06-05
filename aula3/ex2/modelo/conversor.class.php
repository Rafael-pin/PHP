<?php
Class Conversor{

  private $idade;

  public function setIdade(int $idade):void{
    $this->idade= $idade;
  }
  public function getIdade():int{
    return $this->idade;
  }

  public function calcularIdadeMeses():int{
    return $this->idade* 12;
  }

  public function calcularIdadeSemanas():int{
    return $this->idade*52;
  }

  public function calcularIdadeHoras():float{
    return $this->idade*8760;
  }

  public function calcularIdadeMinutos():float{
    return $this->idade*525600;
  }

  public function calcularIdadeSegundos():float{
    return $this->calcularIdadeMinutos()*60;

  }
}
