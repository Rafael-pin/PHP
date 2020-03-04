<?php
class Produto{
  private $idProduto;
  private $nome;
  private $tipo;
  private $marca;
  private $secao;
  private $valorCompra;
  private $valorVenda;
  private $qtd;

  public function __construct(){}
  public function __destruck(){}

  public function __get($a){ return $this->$a; }
  public function __set($a,$v){ $this->$a = $v; }

  public function __toString(){
    return nl2br ("
                   Nome: $this->nome
                   Marca: $this->marca
                   Tipo: $this->tipo
                   Seção: $this->secao
                   Valor de compra: R$ $this->valorCompra
                   Valor de venda: R$ $this->valorVenda
                   Quantidade: $this->qtd");
  }
}
