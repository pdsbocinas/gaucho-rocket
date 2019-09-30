<?php
include("conexion.php");

function getPresentaciones(){
        $conn = getConexion();
        $sql = "SELECT * FROM presentaciones";
        return execute_query( $conn, $sql );
}

function execute_query($conn, $sql){
    $result = mysqli_query($conn, $sql);

    $resultAsArray = Array();
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $element = Array();
            $element['idPresentacion'] =  $row["idPresentacion"];
            $element['nombre'] =  $row["nombre"];
            $element['fecha'] =  $row["fecha"];
            $element['precio'] =  $row["precio"];
            $resultAsArray[] = $element;
        }
    }
    mysqli_close($conn);
    return $resultAsArray;
}
?>