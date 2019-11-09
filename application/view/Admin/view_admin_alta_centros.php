
<form action="<?php echo $path->getEvent('admin', 'guardaCentro'); ?>" method="GET">
<div class="form-group">
<div class="form-group">
     <label for="nro">Numero</label>
     <input type="number" class="form-control" name ="id" value="" aria-describedby="emailHelp" placeholder="numero de Centro">
   </div>
   <div class="form-group">
     <label for="exampleInputPassword1">Nombre</label>
     <input type="text" name="nombre" class="form-control" id="nombre" value="" placeholder="Nombre">
   </div>
   <div class="form-group">
     <label for="exampleInputPassword1">Ubicacion</label>
     <input type="text" name="ubicacion" class="form-control" id="ubicacion" value="" placeholder="ubicacion">
   </div>
   <input type="submit" class="btn btn-primary btn-lg" value="Guardar">
  
 
</form>