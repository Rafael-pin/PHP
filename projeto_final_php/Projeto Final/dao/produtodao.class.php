<?php
require_once "config/conexaobanco.class.php";

class ProdutoDAO{
  private $conexao = null;

  public function __construct(){
    $this->conexao = ConexaoBanco::getInstance();
  }

  public function __destruct(){}

  public function cadastrarProduto($prod){
    try {
      $stat = $this->conexao->prepare("insert into produto(idProduto,nome,tipo,marca,secao,valorCompra,valorVenda,qtd)values(null,?,?,?,?,?,?,?)");
      $stat->bindValue(1, $prod->nome);
      $stat->bindValue(2, $prod->tipo);
      $stat->bindValue(3, $prod->marca);
      $stat->bindValue(4, $prod->secao);
      $stat->bindValue(5, $prod->valorCompra);
      $stat->bindValue(6, $prod->valorVenda);
      $stat->bindValue(7, $prod->qtd);
      $stat->execute();
    } catch (PDOException $e) {
      echo "Erro ao cadastrar produto! ".$e;
    }
  }

  public function buscarProdutos(){
    try {
      $stat = $this->conexao->query("select * from produto");
      $array = $stat->fetchAll(PDO::FETCH_CLASS,"Produto");
      return $array;
    } catch (PDOEException $e) {
      echo "Erro ao buscar produtos!".$e;
    }
  }

  public function deletarProduto($id){
    try {
      $stat = $this->conexao->prepare("delete from produto where idProduto= ?");
      $stat->bindValue(1, $id);
      $stat->execute();
    } catch (\Exception $e) {
      echo "Erro ao excluir produto! ".$e;
    } // fecha catch
  } // fecha deletarLivro

  public function filtrar($filtro, $pesquisa){
    try{
      $query = "";
      switch($filtro){
        case "codigo": $query = "where idProduto = ".$pesquisa;
        break;
        case "nome": $query="where nome like '%".$pesquisa."%'";
        break;
        case "tipo": $query="where tipo like '%".$pesquisa."%'";
        break;
        case "marca": $query="where marca like '%".$pesquisa."%'";
        break;
        case "secao": $query="where secao like '%".$pesquisa."%'";
        break;
        case "valorCompra": $query="where valorCompra like '%".$pesquisa."%'";
        break;
        case "valorVenda": $query="where valorVenda like '%".$pesquisa."%'";
        break;
        case "qtd": $query="where qtd like '%".$pesquisa."%'";
        break;
      }//fecha switch

      if(empty($pesquisa)){
        $query = "";
      }

      $stat=$this->conexao->query("select * from produto ".$query);
      $array=$stat->fetchAll(PDO::FETCH_CLASS, "Produto");
      return $array;
    }catch(PDOException $e){
      echo "Erro ao filtrar! ".$e;
    }//fecha catch
  }

  public function alterarProduto($prod){
    try {
      $stat = $this->conexao->prepare("update produto set nome=?, tipo=?, marca=?, secao=?, valorCompra=?, valorVenda=?, qtd=? where idProduto=?");
      $stat->bindValue(1,$prod->nome);
      $stat->bindValue(2,$prod->tipo);
      $stat->bindValue(3,$prod->marca);
      $stat->bindValue(4,$prod->secao);
      $stat->bindValue(5,$prod->valorCompra);
      $stat->bindValue(6,$prod->valorVenda);
      $stat->bindValue(7,$prod->qtd);
      $stat->bindValue(8,$prod->idProduto);
      $stat->execute();

    } catch (PDOException $e) {
      echo "Erro ao alterar produto ".$e;
    } // fecha catch
  }

}
