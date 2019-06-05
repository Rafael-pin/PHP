<?php
class cliente{

  private $nome;
  private $idade;
  private $sexo;

  public function Cliente() {
  }

  public function getNome():String{
    return $this->nome;
  }

  public function setNome(string $nome):void{
    $this->nome =$nome;
  }

  public function getIdade():int{
    return $this->idade;
  }

  public function setIdade(int $idade):void{
    $this->idade=$idade;
  }

  public function setSexo(string $sexo):void{
    $this->sexo = strtolower($sexo);
  }

  public function getSexo():String{
    return $this->sexo;
  }

  public function calcularIdadeMeses(){
    return $this->idade*12;
  }

  public function verificarSexo(){
    if($this->sexo == "masculino"){
      return "Você é homem!";
    }else if($this->sexo =="feminino"){
      return "Você é mulher!";
    }
      return "Sexo inválido!";
    } 
}//fecha classe
