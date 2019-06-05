<?php session_start();?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1,maximum-scale=1" name="viewport">
    <title>Resposta</title>
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
    	  <h1 class="jumbotron bg-warning">Resposta</h1>
        <?php
        include "modelo/pessoa.class.php";
        $p= unserialize ($_SESSION["pessoa"]);
        echo "<h1>".$_SESSION['msg']."</h1>";
        echo "<p>".$p."</p>";
        unset($_SESSION['msg']);
        unset($_SESSION['pessoa']);
        ?>
    </div>
  </body>
</html>
