<?php
require_once "config/conexaobanco.class.php";

class FuncionarioDAO{
  private $conexao = null;

  public function __construct(){
    $this->conexao = ConexaoBanco::getInstance();
  }

  public function __destruct(){}

  public function cadastrarFuncionario($func){
    try {
      $stat=$this->conexao->prepare("Insert into funcionario(idFuncionario,nome,sexo,cargo,tel,cel,email)values(null,?,?,?,?,?,?)");
      $stat->bindValue(1, $func->nome);
      $stat->bindValue(2, $func->sexo);
      $stat->bindValue(3, $func->cargo);
      $stat->bindValue(4, $func->tel);
      $stat->bindValue(5, $func->cel);
      $stat->bindValue(6, $func->email);
      $stat->execute();
    } catch (PDOException $e) {
      echo "Erro ao cadastrar funcionário!".$e;
    }
  }

  public function buscarFuncionario(){
    try {
      $stat=$this->conexao->query("select *from funcionario");
      $array=$stat->fetchAll(PDO::FETCH_CLASS,"Funcionario");
      return $array;
    } catch (PDOException $e) {
      echo "Erro ao consultar funcionário!".$e;
    }
  }

  public function deletarFuncionario($id){
    try {
      $stat = $this->conexao->prepare("delete from funcionario where idFuncionario= ?");
      $stat->bindValue(1, $id);
      $stat->execute();
    } catch (\Exception $e) {
      echo "Erro ao excluir funcionário! ".$e;
    }
  }

  public function filtrar($filtro, $pesquisa){
    try{
      $query = "";
      switch($filtro){
        case "codigo": $query = "where idFuncionario = ".$pesquisa;
        break;
        case "nome": $query="where nome like '%".$pesquisa."%'";
        break;
        case "sexo": $query="where sexo like '%".$pesquisa."%'";
        break;
        case "cargo": $query="where cargo like '%".$pesquisa."%'";
        break;
        case "tel": $query="where tel like '%".$pesquisa."%'";
        break;
        case "cel": $query="where cel like '%".$pesquisa."%'";
        break;
        case "email": $query="where email like '%".$pesquisa."%'";
        break;
      }//fecha switch

      if(empty($pesquisa)){
        $query = "";
      }

      $stat=$this->conexao->query("select * from funcionario ".$query);
      $array=$stat->fetchAll(PDO::FETCH_CLASS, "Funcionario");
      return $array;
    }catch(PDOException $e){
      echo "Erro ao filtrar! ".$e;
    }//fecha catch
  }

  public function alterarFuncionario($func){
    try {
      $stat = $this->conexao->prepare("update funcionario set nome=?, sexo=?, cargo=?, tel=?, cel=?, email=? where idFuncionario=?");
      $stat->bindValue(1,$func->nome);
      $stat->bindValue(2,$func->sexo);
      $stat->bindValue(3,$func->cargo);
      $stat->bindValue(4,$func->tel);
      $stat->bindValue(5,$func->cel);
      $stat->bindValue(6,$func->email);
      $stat->bindValue(7,$func->idFuncionario);
      $stat->execute();

    } catch (PDOException $e) {
      echo "Erro ao alterar funcionário ".$e;
    } // fecha catch
  }

  public function gerarJSON($filtro, $pesquisa){
    try {
      $query="";
      switch($filtro){
        case "codigo":
        $query = "where idFuncionario = ".$pesquisa;
        break;
      }
    $stat = $this->conexao->query("select * from funcionario ".$query);
    return json_encode($stat->fetchAll(PDO::FETCH_ASSOC));
    } catch (PDOEException $e) {
      echo "Erro ao gerar JSON! ".$e;
    } // fecha catch
  } // fecha gerarJSON

}
