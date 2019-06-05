<?php
class Pessoa{
  private $nome;
  public function __construct(){}
  public function __destruct(){}
  public function __set($a,$v){$this->$a =$v;}
  public function __get($a){return $this->$a;}
  public function __toString(){return nl2br("$this->nome");}
}
