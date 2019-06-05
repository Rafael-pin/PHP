<?php
class Calculadora{
  private $num1;
  private $num2;

  public function Calculadora(){
  }

  public function setNum1(float $num1):void {
    $this->num1 = $num1;
  }
  public function getNum1():float{
    return $this->num1;
  }

  public function setNum2(float $num2):void{
    $this->num2 = $num2;
  }
  public function getNum2():float{
    return $this->num2;
  }

  public function somar():float{
    return $this->num1 + $this->num2;
  }

  public function subtrair():float{
    return $this->num1 - $this->num2;
  }

  public function dividir():float{
    return $this->num1 / $this->num2;
  }

  public function multiplicar():float{
    return $this->num1 * $this->num2;
  }

}
