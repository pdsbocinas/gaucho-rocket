<ul class="d-flex flex-row list-group">
  <li class="list-group-item"><?php echo $fila['reserva_id'] ?></li>
  <li class="list-group-item"><?php echo $fila['codigo'] ?></li>
  <li class="list-group-item"><?php echo $fila['vuelo_id'] ?></li>
  <li class="list-group-item"><?php echo $fila['referencia_vuelo'] ?></li>
  <li class="list-group-item"><?php echo $fila['usuario_id'] ?></li>
  <li class="list-group-item"><a id="<?php echo $fila['reserva_id'] ?>" href="javascript:void(0)" class="btn btn-danger eliminar-reserva">Eliminar</a></li>
</ul>