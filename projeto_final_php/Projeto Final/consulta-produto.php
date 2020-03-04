<?php
session_start();
ob_start();

include_once "modelo/produto.class.php";
include_once "dao/produtodao.class.php";

$proDAO = new ProdutoDAO();
$array = $proDAO->buscarProdutos();
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Consulta de Produtos</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
  <body>
      <div class="container">
        <h1 class="jumbotron bg-info">Consulta de Produtos</h1>

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
                <a class="nav-link" href="consulta-produto.php">Cons. Produtos<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cadastro-funcionario.php">Cad. Funcionário<span class="sr-only"></span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consulta-funcionario.php">Cons. Funcionários<span class="sr-only"></span></a>
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

        <h1>Sistema para gerenciamento de mercado</h1>

        <h2>Consulta de produtos</h2>

        <?php
        if (isset($array)) {
          if ($array==0) {
            echo "<h3>Não há produtos cadastrados no banco de dados!</h3>";
            return;
          }
        }
        ?>

        <form name="pesquisa" method="post" action="">
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
        </form>

        <?php
        if(isset($_POST['filtrar'])){
          $proDAO = new ProdutoDAO();
          $array=$proDAO->filtrar($_POST['selfiltro'],$_POST['txtfiltro']);

          if(count($array) == 0){
            echo "<h2>Sua pesquisa não retornou nenhum produto!</h2>";
            return;
          }
        }
        ?>

         <div class="table-responsive">
           <table class="table table-striped table-bordered table-hover table-condensed">
             <div class="">

             <thead>
               <tr>
                 <th>Código do produto</th>
                 <th>Nome</th>
                 <th>Tipo</th>
                 <th>Marca</th>
                 <th>Seção</th>
                 <th>Valor de compra</th>
                 <th>Valor de venda</th>
                 <th>Quantidade</th>
               </tr>
             </thead>


             <tfoot>
               <tr>
                 <th>Código do produto</th>
                 <th>Nome</th>
                 <th>Tipo</th>
                 <th>Marca</th>
                 <th>Seção</th>
                 <th>Valor de compra</th>
                 <th>Valor de venda</th>
                 <th>Quantidade</th>
               </tr>
             </tfoot>

             <tbody >
               <?php
               include_once 'modelo/usuario.class.php';
               foreach($array as $pro){
                 echo "<tr>";
                   echo "<td>$pro->idProduto</td>";
                   echo "<td>$pro->nome</td>";
                   echo "<td>$pro->tipo</td>";
                   echo "<td>$pro->marca</td>";
                   echo "<td>$pro->secao</td>";
                   echo "<td>$pro->valorCompra</td>";
                   echo "<td>$pro->valorVenda</td>";
                   echo "<td>$pro->qtd</td>";
                   if (isset($_SESSION['privateUser'])) {
                     $u=new Usuario();
                     $u=unserialize($_SESSION['privateUser']);
                     if ($u->tipo=="administrativo" || $u->tipo=="funcionario") {
                       echo "<td><a href='alterar-produto.php?id=$pro->idProduto' class='btn btn-warning'>Alterar</a></td>";
                       echo "<td><a href='consulta-produto.php?id=$pro->idProduto' class='btn btn-danger'>Excluir</a></td>";
                     }
                   }
                 }
                 echo "</tr>";
               ?>
             </tbody>
           </table>
         </div> <!-- fecha class=table-responsive -->
      </div>
      <?php
      if(isset($_GET['id'])){
        $proDAO = new ProdutoDAO();
        $proDAO->deletarProduto($_GET['id']);
        header("location:consulta-produto.php");
      }
      ?>
  </body>
</html>
