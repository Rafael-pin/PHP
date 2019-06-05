<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1,maximum-scale=1" name="viewport">
    <title>Cadastro de pessoa</title>
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    	<style type="text/css">
      .fundo{
        background-color: #f98000;
      }
      .jumbotron{
        text-align: center;
      }
    </style>
  </head>

  <body class="fundo">
    <div class="container">
    	  <h1 class="jumbotron bg-warning">Cadastro de pessoa</h1>
        <?php
        if (isset($_SESSION['erro'])){
          echo "<p>".$_SESSION['erro']."</p>";
          unset($_SESSION['erro']);
        }
        ?>


      <form name="cadaluno" id="cadaluno" method="post" action="controle/pessoa-controle.php">
        <fieldset>
          <legend>Dados</legend>

          <div class="form-group">
            <input type="text" name="txtnome" placeholder="Digite o seu nome" autofocus class="form-control">
          </div>

        	<div class="form-group">
            <input type="submit" value="Cadastrar pessoa" class="btn btn-outline-primary">
            <input type="reset" value="Limpar" class="btn btn-outline-success">
          </div>
        </fieldset>
      </form>
    </div>
  </body>
</html>
