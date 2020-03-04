<?php
session_start();
ob_start();
if(isset($_GET['id'])){
    include_once "modelo/funcionario.class.php";
    include_once "dao/funcionariodao.class.php";
    $funcDAO = new FuncionarioDAO();
    $array = $funcDAO->filtrar("codigo",$_GET['id']);
    $func = $array[0];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Alteração de funcionário</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
  <body>
      <div class="container">
        <h1 class="jumbotron bg-info">Alteração de Funcionário</h1>

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
                <a class="nav-link" href="cadastro-funcionario.php">Cad. Funcionário<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consulta-funcionario.php">Cons. Funcionários<span class="sr-only"></span></a>
              </li>
            </ul>
          </div>
        </nav>

        <form name="altfuncionario" method="post" action="">
          <div class="form-group">
            <input value="<?php if(isset($func)){ echo $func->nome; } ?>" type="text" name="txtnomefunc" placeholder="Nome" class="form-control" pattern="^[a-zA-Z À-ú]{2,50}$" title="Apenas letras" required>
          </div>
          <div class="form-group">
            <label>Masculino<input type="radio" name="selectsexo" value="masculino"  class="form-control" pattern="^(masculino||feminino)$" required
                  <?php if(isset($func)){
                  if($func->sexo == "Masculino"){
                    echo "checked='checked'";
                  }
                } ?>></label>
            <label>Feminino<input type="radio" name="selectsexo" value="feminino" class="form-control" pattern="^(masculino||feminino)$" required
                <?php if(isset($func)){
                if($func->sexo == "Feminino"){
                  echo "checked='checked'";}
                }?>></label>
          </div>
          <div class="form-group">
            <input value="<?php if(isset($func)){ echo $func->cargo; } ?>" type="text" name="txtcargo" placeholder="Cargo" class="form-control" pattern="^[a-zA-Z À-ú]{2,50}$" title="Apenas letras" required>
          </div>
          <div class="form-group">
            <input value="<?php if(isset($func)){ echo $func->tel; } ?>" type="text" name="numtel" placeholder="Telefone" class="form-control" pattern="^[0-9 -()+]{8,20}$" title="Apenas números, '()', '-' e '+'" required>
          </div>
          <div class="form-group">
            <input value="<?php if(isset($func)){ echo $func->cel; } ?>" type="text" name="numcel" placeholder="Celular" class="form-control" pattern="^[0-9 -()+]{9,20}$" title="Apenas números, '()', '-' e '+'" required>
          </div>
          <div class="form-group">
            <input value="<?php if(isset($func)){ echo $func->email; } ?>" type="email" name="email" placeholder="email" class="form-control" required>
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
          include_once "modelo/funcionario.class.php";
          include_once "dao/funcionariodao.class.php";
          include_once "util/padronizacao.class.php";
          include_once "util/validacao.class.php";

          $erros=array();

          if(!Validacao::validarNome($_POST['txtnomefunc'])){
            $erros[]="Nome inválido!";
          }

          if(!Validacao::validarSexo($_POST['selectsexo'])) {
            $erros[]="Sexo inválido!";
          }

          if(!Validacao::validarNome($_POST['txtcargo'])){
            $erros[]="Cargo inválido!";
          }

          if(!Validacao::validarTel($_POST['numtel'])){
            $erros[]="Telefone inválido!";
          }

          if(!Validacao::validarCel($_POST['numcel'])){
            $erros[]="Celular inválido!";
          }

          if(!(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))){
            $erros[]="E-mail inválido!";
          }

          if (count($erros)==0) {
            $func = new Funcionario();
            $func->idFuncionario=$_GET['id'];
            $func->nome = Padronizacao::antiXSS(Padronizacao::converterMainMin($_POST['txtnomefunc']));
            $func->sexo = Padronizacao::antiXSS(Padronizacao::converterMainMin($_POST['selectsexo']));
            $func->cargo = Padronizacao::antiXSS(Padronizacao::converterMainMin($_POST['txtcargo']));
            $func->tel = Padronizacao::antiXSS(($_POST['numtel']));
            $func->cel = Padronizacao::antiXSS(($_POST['numcel']));
            $func->email = Padronizacao::antiXSS(Padronizacao::converterMin($_POST['email']));

            $funcDAO = new FuncionarioDAO();
            $funcDAO->alterarFuncionario($func);
            // $_SESSION['msg'] = "Funcionário alterado com sucesso!";
            header("location:consulta-funcionario.php");
          }else {
            $_SESSION['erros'] = serialize($erros);
            $_SESSION['post'] = serialize($_POST);
            header("location:alterar-funcionario.php");
          }
        }
        ?>
      </div>
  </body>
</html>
