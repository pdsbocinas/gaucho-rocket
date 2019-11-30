<div class="item-reserva">
  <p class="card-text" name='nombre'><?php echo $fila['id'] ?></p>
  <p class="card-text" name='ubicacion'><?php echo $fila['codigo'] ?></p>
  <p class="card-text" name='nombre'><?php echo $fila['fecha'] ?></p>
  <p class="card-text" name='ubicacion'><?php echo $fila['titulo'] ?></p>
  <p class="card-text" name='ubicacion'><?php echo $fila['descripcion'] ?></p>
  <!-- <p class="card-text" name='ubicacion'><?php echo $fila['email'] ?></p> -->
  <!-- <p class="card-text" name='ubicacion'><?php echo $fila['tipo_de_cabina'] ?></p> -->
  <p class="card-text" name='ubicacion'>$ <?php echo $fila['precio_final'] ?></p>
  <!-- <p class="card-text" name='ubicacion'><?php echo $fila['pagada'] ?></p> -->
  <a href="<?php echo $path->getEvent('reservas', 'generaFactura') ?>?codigo=<?php echo $fila['codigo'] ?>" target="_blank" id="reserva-<?php echo $fila['id'] ?>" class="btn <?php echo $fila['pagada'] == 1 ? 'btn-success' : 'btn-primary pagar' ?>"><?php echo $fila['pagada'] == 1 ? 'Descargar factura' : 'Pagar' ?></a>
  <?php 
    if ($fila['pagada'] == 1) {
      if ($fila['checkin']) {
        echo "<button disabled class='btn btn-success' disabled href=". $path->getEvent('micuenta', 'checkin') .">Checkin realizado</button>";
      } else {
        echo "<a class='btn btn-primary' href=". $path->getEvent('micuenta', 'checkin') ."?codigo=". $fila['codigo'] .">Realizar checkin</a>";
      }
    }
  ?>
  <a href="javascript:void(0)" id="reserva-<?php echo $fila['id'] ?>" class='btn btn-danger eliminar-reserva'>Cancelar reserva</a>
</div>