<form class="d-flex flex-row list-group form-lista-de-espera">
  <li class="list-group-item"><?php echo $fila['id'] ?></li>
  <li class="list-group-item"><?php echo $fila['referencia_vuelo'] ?></li>
  <li class="list-group-item"><?php echo $fila['fecha'] ?></li>
  <li class="list-group-item"><?php echo $fila['titulo'] ?></li>
  <li class="list-group-item"><?php echo $fila['nombre_de_usuario'] ?></li>
  <input type="hidden" name="vuelo_id" value="<?php echo $fila['vuelo_id'] ?>" />
  <input type="hidden" name="usuario_id" value="<?php echo $fila['usuario_id'] ?>" />
  <input type="hidden" name="precio_vuelo" value="<?php echo $fila['precio'] ?>" />
  <li class="list-group-item">
    <button type="submit" class="btn btn-primary generar-reserva">Agregar al vuelo</button>
  </li>
</form>