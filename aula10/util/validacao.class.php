<?php
class Validacao{
  public function validarNome($v){
    $exp="/^[A-z ]{2,30}$/";
    return preg_match($exp,$v);
  }
}
//echo Validacao::validarNome("Rafael Pinheiro");
