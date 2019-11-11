
<h1 class="text-center">Editar Centro</h1>
<?php  
    
    foreach ($data as $fila) {
    }
  ?>

 <form action="<?php echo $path->getEvent('admin', 'exito'); ?>" method="POST">
   <div class="form-group">
     <label for="nro">Numero</label>
     <p><?php echo $fila['id']?></p>
     <input type="hidden" class="form-control" name ="id" value="<?php echo $fila['id']?>" aria-describedby="emailHelp"  placeholder="numero de Centro">
   
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