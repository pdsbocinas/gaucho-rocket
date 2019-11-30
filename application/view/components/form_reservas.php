<form action='<?php echo $path->getEvent('reservas', 'confirmarReserva') ?>' method='POST'>
  <h1><?php echo $data[0]['titulo'] ?></h1>
  <p><?php echo $data[0]['descripcion'] ?></p>
  <p style="display: none;" class="precioBase"><?php echo "$ " . $data[0]['precio'] ?></p>
  <p class="precioFinal"><?php echo "$ " . $data[0]['precio'] ?></p>
  <input id="precioFinal" type="hidden" name="precioFinal" value='<?php echo "$ " . $data[0]['precio'] ?>'/>
  <div class="form-group">
    <select id="servicios" name="servicio" class="form-control cabinas">
    </select>
  </div>
  <input type="hidden" value='<?php echo $data[0]['id'] ?>' name='vuelo_id' />
  <?php
    if (is_null($session_null)) {
      echo "<button type='reset' data-toggle='modal' data-target='#exampleModal' class='btn btn-primary white trigger-modal'>Reserva</button>";
    } else {
      echo "<button type='submit' class='btn btn-primary'>Reserva</button>";
    }
  ?>
</form>
