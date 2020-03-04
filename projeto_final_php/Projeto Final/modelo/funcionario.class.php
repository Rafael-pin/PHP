<?php
class Funcionario{
  private $idFuncionario;
  private $nome;
  private $sexo;
  private $cargo;
  private $tel;
  private $cel;
  private $email;
  //private $end;


  public function __construct(){}
  public function __destruck(){}

  public function __set($a,$v){ $this->$a = $v; }
  public function __get($a){ return $this->$a; }

  public function __toString(){
    return nl2br ("
                   Nome: $this->nome
                   Sexo: $this->sexo
                   Cargo: $this->cargo
                   Telefone: $this->tel
                   Celular: $this->cel
                   Email: $this->email");
   }
}
