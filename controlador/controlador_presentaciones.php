<?php
include_once("modelo/modelo_presentaciones.php");

function presentaciones_index(){

    $presentaciones = getPresentaciones();
    include_once("vista/vista_presentaciones.php");
}

?>