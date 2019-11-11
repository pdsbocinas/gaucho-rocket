
<form action="<?php echo $path->getEvent('admin', 'guardaCentro'); ?>" method="POST">
<div class="form-group">
<div class="form-group">
     <label for="id">Numero</label>
     <input type="number" class="form-control" name ="id" disabled aria-describedby="emailHelp" placeholder="numero de Centro">
   </div>
   <div class="form-group">
     <label for="nombre">Nombre</label>
     <input type="text" name="nombre" class="form-control" id="nombre" required placeholder="Nombre">
   </div>
   <div class="form-group">
     <label for="ubicacion">Ubicacion</label>
     <input type="text" name="ubicacion" class="form-control" id="ubicacion" required placeholder="ubicacion">
   </div>	
</div>
   <input type="submit" class="btn btn-primary btn-lg" value="Guardar">
  
 
</form>