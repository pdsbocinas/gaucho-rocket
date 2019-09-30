<?php
include("conexion.php");

function getCanciones(){

    $conn = getConexion();

    $sql = "SELECT * FROM canciones";
    $result = mysqli_query($conn, $sql);

    $canciones = Array();
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $cancion = Array();
            $cancion['idCancion'] =  $row["idCancion"];
            $cancion['nombre'] =  $row["nombre"];
            $cancion['duracion'] =  $row["duracion"];
            $canciones[] = $cancion;
        }
    }


    mysqli_close($conn);

    return $canciones;

}
?>