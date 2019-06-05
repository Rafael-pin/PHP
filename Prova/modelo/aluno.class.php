<?php
class Aluno{
  private $nome;
  private $sobrenome;
  private $sexo;
  private $estadoCivil;
  private $n1;
  private $p1;
  private $n2;
  private $p2;
  private $presenca;
  private $totalAulas;

  public function Aluno(){
  }

  public function getNome():string{
    return $this->nome;
  }

  public function setNome(string $nome):void{
    $this->nome = $nome;
  }

  public function getSobrenome():string{
    return $this->sobrenome;
  }

  public function setSobrenome(string $sobrenome):void{
    $this->sobrenome = $sobrenome;
  }

  public function getSexo():string{
    return $this->sexo;
  }

  public function setSexo(string $sexo):void{
    $this->sexo = $sexo;
  }

  public function getEstadoCivil():string{
    return $this->estadoCivil;
  }

  public function setEstadoCivil(string $estadoCivil):void{
    $this->estadoCivil = $estadoCivil;
  }

  public function getN1():float{
    return $this->n1;
  }

  public function setN1(float $n1):void{
    $this->n1 = $n1;
  }

  public function getP1():float{
    return $this->p1;
  }

  public function setP1(float $p1):void{
    $this->p1 = $p1;
  }

  public function getN2():float{
    return $this->n2;
  }

  public function setN2(float $n2):void{
    $this->n2 = $n2;
  }

  public function getP2():float{
    return $this->p2;
  }

  public function setP2(float $p2):void{
    $this->p2 = $p2;
  }

  public function getPresenca():int{
    return $this->presenca;
  }

  public function setPresenca(float $presenca):void{
    $this->presenca = $presenca;
  }

  public function getTotalAulas():int{
    return $this->totalAulas;
  }

  public function setTotalAulas(float $totalAulas):void{
    $this->totalAulas = $totalAulas;
  }

  public function calcularMediaAritmetica():float{
    return ($this->n1+$this->n2)/2;
  }

  public function calcularMediaPonderada():float{
    return ($this->n1 * $this->p1 + $this->n2 * $this->p2) / ($this->p1 + $this->p2);
  }

  public function calcularFrequencia():float{
    return ($this->presenca*100)/($this->totalAulas);
  }

  public function verificarAprovacao():string{
    if($this->calcularFrequencia() >= 75 & $this->calcularMediaAritmetica() >= 6){
      return "Aprovado.";
    }
    return "Reprovado";
  }

  public function verificarConceito():string{
    if ($this->calcularMediaAritmetica() >= 9) {
      return "Nota A";
    }else if ($this->calcularMediaAritmetica() >=8) {
      return "Nota B";
    }else if ($this->calcularMediaAritmetica() >=6){
      return "Nota C";
    }
    return "Nota D";
  }
}
