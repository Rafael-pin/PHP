<?php
session_start();
ob_start();

include_once "modelo/funcionario.class.php";
include_once "dao/funcionariodao.class.php";

$funcDAO = new FuncionarioDAO();
$array = $funcDAO->buscarFuncionario();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Consulta de Funcionário</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
  <body>
      <div class="container">
        <h1 class="jumbotron bg-info">Consulta de Funcionário</h1>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">Sistema</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cadastro-produto.php">Cad. Produto<span class="sr-only"></span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consulta-produto.php">Cons. Produtos<span class="sr-only"></span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cadastro-funcionario.php">Cad. Funcionário<span class="sr-only"></span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consulta-funcionario.php">Cons. Funcionários<span class="sr-only">(current)</span></a>
              </li>
              <?php
              if(isset($_SESSION['privateUser'])){
                include_once "modelo/usuario.class.php";
                $u = unserialize($_SESSION['privateUser']);
                if($u->tipo == "administrativo"){
              ?>
                  <li class="nav-item">
                    <a class="nav-link" href="consulta-usuario.php">Cons. Usuários <span class="sr-only"></span></a>
                  </li>
              <?php
                }
              }
              ?>
            </ul>
          </div>
        </nav>


        <?php
        if (isset($array)) {
          if ($array==0) {
            echo "<h3>Não há funcionários cadastrados no banco de dados!</h3>";
            return;
          }
        }
        if (isset($_SESSION['privateUser'])) {
          include_once 'modelo/usuario.class.php';
          $u=new Usuario();
          $u=unserialize($_SESSION['privateUser']);
          if ($u->tipo=="administrativo") {
         ?>

         <h1>Sistema para gerenciamento de mercado</h1>

         <h2>Consulta de funcionários</h2>
         <form name="pesquisa" method="post" action="">
           <div class="row">
             <div class="form-group col-md-6">
               <input type="text" name="txtfiltro" class="form-control" placeholder="Digite sua pesquisa">
             </div>
             <div class="form-group col-md-6">
               <select name="selfiltro" class="form-control">
                 <option value="todos">Todos</option>
                 <option value="codigo">Código do funcionário</option>
                 <option value="nome">Nome</option>
                 <option value="sexo">Sexo</option>
                 <option value="cargo">Cargo</option>
                 <option value="tel">Telefone</option>
                 <option value="cel">Celular</option>
                 <option value="email">E-mail</option>
               </select>
             </div>
           </div>
           <div class="form-group">
             <input type="submit" name="filtrar" value="Filtrar" class="btn btn-primary btn-block">
           </div>
         </form>

         <?php

           if(isset($_POST['filtrar'])){
             $funcDAO = new FuncionarioDAO();
             $array=$funcDAO->filtrar($_POST['selfiltro'],$_POST['txtfiltro']);

             if(count($array) == 0){
               echo "<h2>Sua pesquisa não retornou nenhum funcionário!</h2>";
               return;
             }
           }
           ?>

           <div class="table-responsive">
             <table class="table table-striped table-bordered table-hover table-condensed">
               <div class="">

               <thead>
                 <tr>
                   <th>Código do Funcionário</th>
                   <th>Nome</th>
                   <th>Sexo</th>
                   <th>Cargo</th>
                   <th>Telefone</th>
                   <th>Celular</th>
                   <th>E-mail</th>
                 </tr>
               </thead>

               <tfoot>
                 <tr>
                   <th>Código do Funcionário</th>
                   <th>Nome</th>
                   <th>Sexo</th>
                   <th>Cargo</th>
                   <th>Telefone</th>
                   <th>Celular</th>
                   <th>E-mail</th>
                 </tr>
               </tfoot>

               <tbody >
                 <?php
                 foreach($array as $func){
                   echo "<tr>";
                     echo "<td>$func->idFuncionario</td>";
                     echo "<td>$func->nome</td>";
                     echo "<td>$func->sexo</td>";
                     echo "<td>$func->cargo</td>";
                     echo "<td>$func->tel</td>";
                     echo "<td>$func->cel</td>";
                     echo "<td>$func->email</td>";


                     echo "<td><a href='alterar-funcionario.php?id=$func->idFuncionario' class='btn btn-warning'>Alterar</a></td>";
                     echo "<td><a href='consulta-funcionario.php?id=$func->idFuncionario' class='btn btn-danger'>Excluir</a></td>";


                   echo "</tr>";
                 }
               ?>
             </tbody>
           </table>
         </div> <!-- fecha class=table-responsive -->
      </div>
      <?php
          if(isset($_GET['id'])){
            $funcDAO = new FuncionarioDAO();
            $funcDAO->deletarFuncionario($_GET['id']);
            header("location:consulta-funcionario.php");
          }
        }elseif ($u->tipo=="funcionario" || $u->tipo=="visitante") {
          echo "<h2>Somente administradores podem acessar essa página!<h2>";
          echo '<script>alert("Para acessar logue como administrador")</script>';
        }
        }else {
          echo "<h2>Somente administradores podem acessar essa página!<h2>";
          echo '<script>alert("Para acessar logue como administrador")</script>';
        }
      ?>
  </body>
</html>
