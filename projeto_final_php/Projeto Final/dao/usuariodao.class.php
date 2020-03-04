<?php
require_once 'config/conexaobanco.class.php';
 class UsuarioDAO {

   private $conexao = null;

   public function __construct(){
     $this->conexao = ConexaoBanco::getInstance();
   }

   public function __destruct(){}

   public function cadastrarUsuario($usu){
     try {
       $stat = $this->conexao->prepare("insert into usuario(idUsuario,login,senha,tipo)values(null,?,?,?)");
       $stat->bindValue(1, $usu->login);
       $stat->bindValue(2, $usu->senha);
       $stat->bindValue(3, $usu->tipo);
       $stat->execute();
     } catch (PDOException $e) {
       echo "Erro ao cadastrar usuário! ".$e;
     }
   }

   public function buscarUsuarios(){
     try {
       $stat = $this->conexao->query("select * from usuario");
       $array = $stat->fetchAll(PDO::FETCH_CLASS,"Usuario");
       return $array;
     } catch (PDOEException $e) {
       echo "Erro ao buscar usuários!".$e;
     }
   }

   public function deletarUsuario($id){
     try {
       $stat = $this->conexao->prepare("delete from usuario where idUsuario= ?");
       $stat->bindValue(1, $id);
       $stat->execute();
     } catch (\Exception $e) {
       echo "Erro ao excluir usuário! ".$e;
     } // fecha catch
   }


   //filtrarUsuarios($filtro, $pesquisa)


   public function verificarUsuario($u){
     try{
       $stat = $this->conexao->prepare("select * from usuario where login = ? and senha = ? and tipo = ?");

       $stat->bindValue(1, $u->login);
       $stat->bindValue(2, $u->senha);
       $stat->bindValue(3, $u->tipo);

       $stat->execute();

       $usuario = null;
       $usuario = $stat->fetchObject('Usuario');
       return $usuario;
     }catch(PDOException $e){
       echo "Erro ao buscar usuarios! ".$e;
     }//fecha catch
   }
 }//fecha classe
