<form action='<?php echo $path->getEvent('reservas', 'confirm') ?>' method='POST'>
  <h1><?php echo $data[0]['titulo'] ?></h1>
  <p><?php echo $data[0]['vueloDescripcion'] ?></p>
  <p><?php echo "$ " . $data[0]['precio'] ?></p>
  <input type="hidden" value='<?php echo $data[0]['id'] ?>' name='id' />
  <button type="submit" class='btn btn-primary'>Reserva</button>
</form>
