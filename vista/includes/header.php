<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<?php
  echo 
    "<header class='navbar navbar-expand-lg navbar-light bg-light'>
      <div class='container'>
        <div class='row'>";
          if (isset($_SESSION['usuario'])) {
            echo
            "
            <p class='col'> Bienvenido: " . $_SESSION["rol"] ." " . $_SESSION["usuario"] . "</p>
            <form class='col' action='actionLogout.php' method='POST'>
              <button type='submit' name='cerrar' class='btn btn-link'>Cerrar</button>
            </form>";
          } else {
            echo 
            "<form class='form-inline my-2 my-lg-0' action='ingresarAction.php' method='POST'>
              <div class='form-group'>
                <input class='form-control mr-sm-2' type='text' name='email' required class='form-control' placeholder='email'>
                <input class='form-control mr-sm-2' type='text' name='password' required class='form-control' placeholder='contraseña'>
              </div>
              <button type='submit' name='ingreso' class='btn btn-outline-success my-2 my-sm-0'>Entrar</button>
            </form>";
          }
      echo
      "</div>
    </div>
  </header>";
?>
  <main>  
