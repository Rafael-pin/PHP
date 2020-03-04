<?php
session_start();
ob_start();

include_once "modelo/usuario.class.php";
include_once "dao/usuariodao.class.php";

$uDAO = new UsuarioDAO();
$array = $uDAO->buscarUsuarios();
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Consulta de Usuários</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
  <body>
      <div class="container">
        <h1 class="jumbotron bg-info">Consulta de Usuários</h1>

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
                <a class="nav-link" href="consulta-funcionario.php">Cons. Funcionários<span class="sr-only"></span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consulta-usuario.php">Cons. Usuários<span class="sr-only">(current)</span></a>
              </li>
            </ul>
          </div>
        </nav>

        <h1>Sistema para gerenciamento de mercado</h1>

        <h2>Consulta de usuários</h2>

        <?php
        if (isset($array)) {
          if ($array==0) {
            echo "<h3>Não há usuários cadastrados no banco de dados!</h3>";
            return;
          }
        }
        if (isset($_SESSION['privateUser'])) {
          include_once 'modelo/usuario.class.php';
          $u=new Usuario();
          $u=unserialize($_SESSION['privateUser']);
          if ($u->tipo=="administrativo") {
        ?>

        <!-- <form name="pesquisa" method="post" action="">
          <div class="row">
            <div class="form-group col-md-6">
              <input type="text" name="txtfiltro" class="form-control" placeholder="Digite sua pesquisa">
            </div>
            <div class="form-group col-md-6">
              <select name="selfiltro" class="form-control">
                <option value="todos">Todos</option>
                <option value="codigo">Código do produto</option>
                <option value="nome">Nome</option>
                <option value="tipo">Tipo</option>
                <option value="marca">Marca</option>
                <option value="secao">Seção</option>
                <option value="valorCompra">Valor de compra</option>
                <option value="ValorVenda">Valor de venda</option>
                <option value="qtd">Quantidade</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <input type="submit" name="filtrar" value="Filtrar" class="btn btn-primary btn-block">
          </div>
        </form> -->

        <?php
        // if(isset($_POST['filtrar'])){
        //   $proDAO = new ProdutoDAO();
        //   $array=$proDAO->filtrar($_POST['selfiltro'],$_POST['txtfiltro']);
        //
        //   if(count($array) == 0){
        //     echo "<h2>Sua pesquisa não retornou nenhum produto!</h2>";
        //     return;
        //   }
        // }
        ?>

         <div class="table-responsive">
           <table class="table table-striped table-bordered table-hover table-condensed">
             <div class="">

             <thead>
               <tr>
                 <th>Código do usuário</th>
                 <th>Login</th>
                 <th>Senha</th>
                 <th>tipo</th>
               </tr>
             </thead>


             <tfoot>
               <tr>
                 <th>Código do usuário</th>
                 <th>Login</th>
                 <th>Senha</th>
                 <th>tipo</th>
               </tr>
             </tfoot>

             <tbody >
               <?php
               include_once 'modelo/usuario.class.php';
               foreach($array as $u){
                 echo "<tr>";
                   echo "<td>$u->idUsuario</td>";
                   echo "<td>$u->login</td>";
                   echo "<td>$u->senha</td>";
                   echo "<td>$u->tipo</td>";
                   echo "<td><a href='consulta-usuario.php?id=$u->idUsuario' class='btn btn-danger'>Excluir</a></td>";
                 echo "</tr>";
               }
               ?>
             </tbody>
           </table>
         </div> <!-- fecha class=table-responsive -->
      </div>
      <?php
      if(isset($_GET['id'])){
        $uDAO = new UsuarioDAO();
        $uDAO->deletarUsuario($_GET['id']);
        header("location:consulta-usuario.php");
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
