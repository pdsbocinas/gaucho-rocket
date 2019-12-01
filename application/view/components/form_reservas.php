<form class="form-reserva card" action='<?php echo $path->getEvent('reservas', 'confirmarReserva') ?>' method='POST'>
  <h1><?php echo $data[0]['titulo'] ?></h1>
  <p><?php echo $data[0]['descripcion'] ?></p>
  <p style="display: none;" class="precioBase"><?php echo "$ " . $data[0]['precio'] ?></p>
  <p class="precioFinal"><?php echo "$ " . $data[0]['precio'] ?></p>
  <input id="precioFinal" type="hidden" name="precioFinal" value='<?php echo "$ " . $data[0]['precio'] ?>'/>
  <ul class="d-flex mt-3 mb-3" id="lista-de-escalas"></ul>
  <div class="form-group">
    <select id="servicios" name="servicio" class="form-control select-width cabinas">
    </select>
  </div>
  <div class="form-group">
    <select id="menu" name="menu" class="form-control select-width menu">
      <option value="standard">Standard</option>
      <option value="gourmet">Gourmet (10%)</option>
      <option value="spa">Spa (15%)</option>
    </select>
  </div>
  <input type="hidden" value='<?php echo $data[0]['id'] ?>' name='vuelo_id' />
  <?php
    if (is_null($_SESSION['userId'])) {
      echo "<button type='reset' data-toggle='modal' data-target='#exampleModal' class='btn btn-primary white trigger-modal'>Reserva</button>";
    } else {
      echo "<button type='submit' class='btn btn-primary'>Reserva</button>";
    }
  ?>
</form>
