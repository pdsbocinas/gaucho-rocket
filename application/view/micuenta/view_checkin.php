<form action="<?php  echo $path->getEvent('micuenta', 'traeReservasParaRealizarCheckin');?>" method="GET">
<div class="form-group">
     <label for="nombre">Codigo de Reserva</label>
     <input type="text" name="codigo" class="form-control" id="codigo" required placeholder="Codigo de Reserva">
   </div>   
   <div class="form-group">
     <label for="id">Id de Usuario</label>
     <input type="number" name="id" class="form-control" id="id" required placeholder="Id de Usuario">
   </div>	
</div>
   <input type="submit" class="btn btn-primary btn-lg" value="BUSCAR">
</form>