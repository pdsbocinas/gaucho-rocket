<div>
  <p class="card-text" name='nombre'><?php echo $fila->id ?></p>
  <p class="card-text" name='ubicacion'><?php echo $fila->codigo ?></p>
  <p class="card-text" name='nombre'><?php echo $fila->fecha ?></p>
  <p class="card-text" name='ubicacion'><?php echo $fila->vuelo_id ?></p>
  <p class="card-text" name='ubicacion'><?php echo $fila->servicio_id ?></p>
  <p class="card-text" name='ubicacion'><?php echo $fila->usuario_id ?></p>
  <p class="card-text" name='ubicacion'><?php echo $fila->tipo_de_cabina ?></p>
  <p class="card-text" name='ubicacion'><?php echo $fila->precio_final ?></p>
  <p class="card-text" name='ubicacion'><?php echo $fila->pagada ?></p>
  <a href="javascript:void(0)" id="reserva-<?php echo $fila->id ?>" class="btn <?php echo $fila->pagada == 1 ? 'btn-success disabled' : 'btn-primary pagar' ?>"><?php echo $fila->pagada == 1 ? 'Pagada' : 'Pagar' ?></a>
</div>