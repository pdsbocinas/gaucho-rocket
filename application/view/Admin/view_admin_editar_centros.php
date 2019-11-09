
<h1> Aca estariamos editando el centro</h1>
<?php  
    
    foreach ($data as $fila) {
    }
  ?>

 <form action="<?php echo $path->getEvent('admin', 'exito'); ?>" method="GET">
   <div class="form-group">
     <label for="nro">Numero</label>
     <input type="number" class="form-control" name ="id" value="<?php echo $fila['id']?>" aria-describedby="emailHelp" placeholder="numero de Centro">
   </div>
   <div class="form-group">
     <label for="exampleInputPassword1">Nombre</label>
     <input type="text" name="nombre" class="form-control" id="nombre" value="<?php echo $fila['nombre']?>" placeholder="Nombre">
   </div>
   <div class="form-group">
     <label for="exampleInputPassword1">Ubicacion</label>
     <input type="text" name="ubicacion" class="form-control" id="ubicacion" value="<?php echo $fila['ubicacion']?>" placeholder="ubicacion">
   </div>
   
   <button type="submit" class="btn btn-primary">Editar/Guardar</button>
   
 </form>