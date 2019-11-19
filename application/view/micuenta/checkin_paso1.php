<div class="container border-primary">
<?php
    foreach ($data as $key => $fila) {
        $myIdFecha=$fila['fecha'];
        echo "<div>id: $fila[id]</div>";
        echo "<div>codigo reserva :$fila[codigo]</div>";
        echo "<div> fecha de salida: $fila[fecha]</div>";
        echo "<div>id vuelo :$fila[vuelo_id]</div>";
        echo "<div>id de servicio: $fila[servicio_id]</div>";
        echo "<div>id de usuario: $fila[usuario_id]</div>";
        echo "<div>precio final: $fila[precio_final]</div>";
        echo "<div>tipo de cabina: $fila[tipo_de_cabina]</div>";
        $fecha_salida_vuelo = date("Y-m-d H:i:s",strtotime($myIdFecha));
            //echo $fecha_salida_vuelo ." fecha de salida de vuelo<br>";
            //$fecha_actual= date("Y-m-d H:i:s");s
        $fecha_hora_actual = date("Y-m-d H:i:s"); 
            //echo $fecha_hora_actual.' fecha actual<br>';
        $fecha_viaje =  date("Y-m-d H:i:s",strtotime($fecha_salida_vuelo));
            //resta 2 horas
        $fecha_viaje_menos2hs= date("Y-m-d H:i:s",strtotime($fecha_viaje. "- 2 hour"));
           // echo $fecha_viaje_menos2hs.'restada 2 horas<br>';
            //resto 1 dia
        $fecha_viaje_menos1dia = date("Y-m-d H:i:s",strtotime($fecha_viaje."- 1 day"));
            //echo $fecha_viaje_menos1dia.' restado 1 dia<br>';
        //echo $fecha_salida_vuelo;   
        if ($fecha_hora_actual >= $fecha_viaje_menos1dia && $fecha_hora_actual <= $fecha_viaje_menos2hs) {
             ?>
            <a class='btn btn-success' href='<?php echo  $path->getEvent('micuenta','checkinPaso2')?>'>Puede realizar el checkin</a>
            <?php
        }
        elseif($fecha_hora_actual > $fecha_viaje_menos2hs){
            echo "<div class='alert alert-danger' role='alert'>Vencìo el tiempo para realizar el Checkin</div>";
            }else{
                echo "<div class='alert alert-info' role='alert'>Todavia no se habilito el checkin,estate atento</div>";
        }
    }
?>
</div>
