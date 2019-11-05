<form action='' method='POST'>
  <h1><?php echo $fila['titulo'] ?></h1>
  <p><?php echo $fila['vueloDescripcion'] ?></p>
  <p><?php echo "$ " . $fila['precio'] ?></p>
  <input type="hidden" value='<?php echo $fila['id'] ?>' name='id' />
  <button type="submit" class='btn btn-primary'>Reserva</button>
</form>
