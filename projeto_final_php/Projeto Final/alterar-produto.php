<?php
session_start();
ob_start();
if(isset($_GET['id'])){
    include_once "modelo/produto.class.php";
    include_once "dao/produtodao.class.php";
    $prodDAO = new ProdutoDAO();
    $array = $prodDAO->filtrar("codigo",$_GET['id']);
    $prod = $array[0];
    // var_dump($array);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Alteração de Produto</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
  <body>
      <div class="container">
        <h1 class="jumbotron bg-info">Alteração de Produto</h1>

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
                <a class="nav-link" href="cadastro-produto.php">Cad. Produto<span class="sr-only">(current)</span></a>
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
            </ul>
          </div>
        </nav>

        <form name="altproduto" method="post" action="">
          <div class="form-group">
            <input value="<?php if(isset($prod)){ echo $prod->nome; } ?>" type="text" name="txtnome" placeholder="Nome" class="form-control" pattern="^[a-zA-ZÀ-ú0-9 -+.&:]{2,75}$" title="Apenas letras, números, '-', '+', '&' e ':'" >
          </div>
          <div class="form-group">
            <input value="<?php if(isset($prod)){ echo $prod->tipo; } ?>" type="text" name="txttipo" placeholder="Tipo" class="form-control" pattern="^[a-zA-Z À-ú]{2,50}$" title="Apenas letras" >
          </div>
          <div class="form-group">
            <input value="<?php if(isset($prod)){ echo $prod->marca; } ?>" type="text" name="txtmarca" placeholder="Marca" class="form-control" pattern="^[a-zA-ZÀ-ú0-9 -+.&:]{2,75}$" title="Apenas letras, números, '-', '+', '&' e ':'" >
          </div>
          <div class="form-group">
            <select name="selsecao" class="form-control" pattern="^(Alimentos||Limpeza||Bazar||Higiene e Beleza||Outros)$" >

              <option value="Alimentos"<?php if(isset($prod)){
                                        if($prod->secao == "Alimentos"){
                                          echo "selected='selected'";}
                                        }?>>Alimentos</option>
              <option value="Limpeza"<?php if(isset($prod)){
                                        if($prod->secao == "Limpeza"){
                                          echo "selected='selected'";}
                                        }?>>Limpeza</option>
              <option value="Bazar"<?php if(isset($prod)){
                                        if($prod->secao == "Bazar"){
                                          echo "selected='selected'";}
                                        }?>>Bazar</option>
              <option value="Higiene e Beleza" <?php if(isset($prod)){
                                        if($prod->secao == "Higiene e Beleza"){
                                          echo "selected='selected'";}
                                        }?>>Higiene e Beleza</option>
              <option value="Outros"<?php if(isset($prod)){
                                        if($prod->secao == "Outros"){
                                          echo "selected='selected'";}
                                        }?>>Outros</option>
            </select>
          </div>
          <div class="form-group">
            <input value="<?php if(isset($prod)){ echo $prod->valorCompra; } ?>"type="text" name="txtvalorcompra" placeholder="Valor de compra" class="form-control" pattern="^[0-9.,]{1,20}$" title="Apenas números, ',' e '.'" >
          </div>

          <div class="form-group">
            <input value="<?php if(isset($prod)){ echo $prod->valorVenda; } ?>" type="text" name="txtvalorvenda" placeholder="Valor de venda" class="form-control" pattern="^[0-9.,]{1,20}$" title="Apenas números, ',' e '.'" required>
          </div>
          <div class="form-group">
            <input value="<?php if(isset($prod)){ echo $prod->qtd; } ?>" type="number" min="0" name="txtqtd" placeholder="Quantidade" class="form-control" pattern="^[0-9.]{1,5}$" title="Apenas números" required>
          </div>

          <div class="form-group">
            <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
            <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
          </div>

        </form>

        <?php
        if (isset($_SESSION['msg'])) {
          echo "<h2>".$_SESSION['msg']."</h2>";
          unset($_SESSION['msg']);
        }

        if(isset($_POST['alterar'])){
          include_once "modelo/produto.class.php";
          include_once "dao/produtodao.class.php";
          include_once "util/padronizacao.class.php";
          include_once "util/validacao.class.php";

          $erros=array();

          if (!Validacao::validarNomeProduto($_POST['txtnome'])){
            $erros[]="Nome inválido!";
          }


          if (!Validacao::validarNome($_POST['txttipo'])){
            $erros[]="Tipo inválido!";
          }


          if (!Validacao::validarNomeProduto($_POST['txtmarca'])){
            $erros[]="Marca inválida!";
          }


          if(!Validacao::validarSec($_POST['selsecao'])){
            $erros[]="Opção de seção inválida!";
          }

          if(!Validacao::validarPreco($_POST['txtvalorcompra'])){
            $erros[]="Valor de compra inválido!";
          }
          if(!Validacao::validarPreco($_POST['txtvalorvenda'])){
            $erros[]="Valor de venda inválido!";
          }

          if (!validacao::validarQtd($_POST['txtqtd'])) {
            $erros[]="Quantidade inválida!";
          }


          if (count($erros)==0){
            $prod = new Produto();
            $prod->idProduto=$_GET['id'];
            $prod->nome = Padronizacao::antiXSS(Padronizacao::converterMainMin($_POST['txtnome']));
            $prod->tipo = Padronizacao::antiXSS(Padronizacao::converterMainMin($_POST['txttipo']));
            $prod->marca = Padronizacao::antiXSS(Padronizacao::converterMainMin($_POST['txtmarca']));
            $prod->secao = Padronizacao::antiXSS(Padronizacao::converterMainMin($_POST['selsecao']));
            $prod->valorCompra = Padronizacao::antiXSS($_POST['txtvalorcompra']);
            $prod->valorVenda = Padronizacao::antiXSS($_POST['txtvalorvenda']);
            $prod->qtd= Padronizacao::antiXSS($_POST['txtqtd']);

            $prodDAO = new ProdutoDAO();
            $prodDAO->alterarProduto($prod);
            // $_SESSION['msg'] = "Produto alterado com sucesso!";
            header("location:consulta-produto.php");
          }else{
            $_SESSION['erros'] = serialize($erros);
            $_SESSION['post'] = serialize($_POST);
            header("location:alterar-produto.php");
          }
        }
        ?>
      </div>
  </body>
</html>
