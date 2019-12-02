
<h1 class="text-center">Editar Vuelo</h1>
<?php  
    
    foreach ($data as $fila) {
?>
   
 <form action="<?php echo $path->getEvent('admin', 'actualizaVuelo'); ?>" class="container"  method="POST" enctype="multipart/form-data">
  <div class="form-group">
     <label for="id">id</label>
     <p><?php echo $fila['id']?></p>
     <input type="hidden" class="form-control" name ="id" value="<?php echo $fila['id']?>" aria-describedby="emailHelp"  placeholder="Id viaje ">
   </div>
   <div class="form-group">
     <label for="titulo">Titulo</label>
     <input type="text" name="titulo" class="form-control" id="titulo" value="<?php echo $fila['titulo']?>" required placeholder="Titulo">
   </div>
   <div class="form-group">
     <label for="precio">Precio</label>
     <input type="number" name="precio" class="form-control" id="precio" value="<?php echo $fila['precio']?>" required placeholder="Precio">
   </div>
   <div class="form-group">
     <label for="fecha_salida">Fecha de Salida</label>
     <input type="date" name="fecha_salida" class="form-control" id="fecha_salida" value="<?php echo $fila['fecha_salida']?>" required placeholder="Fecha de Salida">
   </div>
   <div class="form-group">
     <label for="fecha_llegada">Fecha de LLegada</label>
     <input type="date" name="fecha_llegada" class="form-control" id="fecha_llegada" value="<?php echo $fila['fecha_llegada']?>" required placeholder="Fecha de LLegada">
   </div>
   <div class="form-group">
       <label for="origen_id">Origen</label>
       <input type="number" name="origen_id" class="form-control" id="origen_id" value="<?php echo $fila['origen_id']?>" required placeholder="Origen">
    </div>
    <div class="form-group">
        <label for="destino_id">Destino</label>
        <input type="number" name="destino_id" class="form-control" id="destino_id" value="<?php echo $fila['destino_id']?>" required placeholder="Destino">
    </div>
    <div class="form-group">
        <label for="tarifa_id">Tarifa</label>
        <input type="number" name="tarifa_id" class="form-control" id="tarifa" value="<?php echo $fila['tarifa_id']?>" required placeholder="Tarifa">
    </div>
    <div class="form-group">
        <label for="equipo_id">Avion</label>
        <input type="number" name="avion_id" class="form-control" id="avion_id" value="<?php echo $fila['avion_id']?>" required placeholder="Avion">
    </div>
    <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" value="<?php echo $fila['descripcion']?>" class="form-control" id="descripcion"  placeholder="Descripcion">
    </div>
    <div class="form-group">
        <label for="direccion">Imagen</label>
        <input type="file" name="ruta"  class="form-control" id="ruta" value="<?php echo $fila['ruta']?>">
    </div>
    <input type="submit" class="btn btn-primary btn-lg" value="Guardar">
 
</form>
<?php }
  ?>