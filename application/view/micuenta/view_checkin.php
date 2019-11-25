<div class="container">
  <h3>Ingresa tu codigo de reserva</h3>
  <form action="<?php  echo $path->getEvent('micuenta', 'traeReservasParaRealizarCheckin');?>" method="GET">
    <div class="form-group">
      <label for="nombre">Codigo de Reserva</label>
      <input type="text" name="codigo" class="form-control" id="codigo" required placeholder="Codigo de Reserva">
    </div>   	
    <input type="submit" class="btn btn-primary btn-lg" value="BUSCAR">
  </form>
</div>