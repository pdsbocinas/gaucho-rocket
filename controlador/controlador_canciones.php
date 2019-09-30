<?php
include("modelo/modelo_canciones.php");


function canciones_index(){
    $canciones = getCanciones();

    include("vista/vista_canciones.php");
}



