<?php
  require_once './modelo/modelo_usuario.php';

  function home_index(){  
    $usuario = new Usuario();
    $datos = $usuario->getAll();
    include("vista/vista_home.php");
  }
?>

