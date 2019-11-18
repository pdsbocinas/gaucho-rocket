<form action='<?php echo $path->getEvent('reservas', 'confirm') ?>' method='POST'>
  <h1><?php echo $data[0]['titulo'] ?></h1>
  <p><?php echo $data[0]['descripcion'] ?></p>
  <p style="display: none;" class="precioBase"><?php echo "$ " . $data[0]['precio'] ?></p>
  <p class="precioFinal"><?php echo "$ " . $data[0]['precio'] ?></p>
  <input id="precioFinal" type="hidden" name="precioFinal" value='<?php echo "$ " . $data[0]['precio'] ?>'/>
  <div class="form-group">
    <select id="servicios" name="servicio" class="form-control cabinas">
    </select>
  </div>
  <input type="hidden" value='<?php echo $data[0]['id'] ?>' name='id' />
  <button type="submit" class='btn btn-primary'>Reserva</button>
</form>
