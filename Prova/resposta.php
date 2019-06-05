<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Dados do aluno</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta content="width=device-width, initial-scale=1,maximum-scale=1" name="viewport">
    <style type="text/css">
      .jumbotron{
        text-align: center;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1 class="jumbotron bg-warning">Dados</h1>
      <?php
      // echo "<p>Nome: ".$_GET['nome'].
      //      "<br>Sobrenome: ".$_GET['sobrenome'].
      //      "<br>Sexo: ".$_GET['sexo'].
      //      "<br>Estado civil: ".$_GET['estadocivil'].
      echo "<p>Nota 1: ".$_GET['n1'].
           "<br>Peso 1: ".$_GET['p1'].
           "<br>Nota 2: ".$_GET['n2'].
           "<br>Peso 2: ".$_GET['p2'].
           "<br>Presença: ".$_GET['presenca'].
           "<br>Total de aulas: ".$_GET['aulas'].
           "<br>Média aritmética: ".$_GET['mari'].
           "<br>Média ponderada: ".$_GET['mpon'].
           "<br>Frequencia: ".number_format($_GET['freq'],2)."%".
           "<br>Resultado: ".$_GET['apr'].
           "<br>Conceito: ".$_GET['con']."</p>";
       ?>
       <a class="btn btn-outline-acess" href="cadastro-aluno.html">Voltar</a>
    </div>
  </body>
</html>
