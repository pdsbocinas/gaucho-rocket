<form action='<?php echo $path->getEvent('reservas', 'confirm') ?>' method='POST'>
  <h1><?php echo $data[0]['titulo'] ?></h1>
  <p><?php echo $data[0]['descripcion'] ?></p>
  <p><?php echo "$ " . $data[0]['precio'] ?></p>
  <div class="form-group">
    <select name="servicio" class="form-control cabinas">
      <option value="general">General</option>
      <option value="familiar">Familiar</option>
      <option value="suite">Suite</option>
    </select>
  </div>
  <input type="hidden" value='<?php echo $data[0]['id'] ?>' name='id' />
  <button type="submit" class='btn btn-primary'>Reserva</button>
</form>
