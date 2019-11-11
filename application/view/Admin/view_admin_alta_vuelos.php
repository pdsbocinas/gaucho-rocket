<form action="<?php echo $path->getEvent('admin', 'guardaVuelo'); ?>" method="POST">
<div class="form-group">
<div class="form-group">
     <label for="nro">id</label>
     <input type="number" class="form-control" name ="id" value="" aria-describedby="emailHelp" disabled placeholder="Id viaje ">
   </div>
   <div class="form-group">
     <label for="titulo">Titulo</label>
     <input type="text" name="titulo" class="form-control" id="titulo" value="" required placeholder="Titulo">
   </div>
   <div class="form-group">
     <label for="precio">Precio</label>
     <input type="number" name="precio" class="form-control" id="precio" value="" required placeholder="Precio">
   </div>
   <div class="form-group">
     <label for="fecha_salida">Fecha de Salida</label>
     <input type="date" name="fecha_salida" class="form-control" id="fecha_salida" value="" required placeholder="Fecha de Salida">
   </div>
   <div class="form-group">
     <label for="fecha_llegada">Fecha de LLegada</label>
     <input type="date" name="fecha_llegada" class="form-control" id="fecha_llegada" value="" required placeholder="Fecha de LLegada">
   </div>
   <div class="form-group">
       <label for="origen_id">Origen</label>
       <input type="number" name="origen_id" class="form-control" id="origen_id" value="" required placeholder="Origen">
    </div>
    <div class="form-group">
        <label for="destino_id">Destino</label>
        <input type="number" name="destino_id" class="form-control" id="destino_id" value="" required placeholder="Destino">
    </div>
    <div class="form-group">
        <label for="tarifa_id">Tarifa</label>
        <input type="number" name="tarifa_id" class="form-control" id="tarifa" value="" required placeholder="Tarifa">
    </div>
    <div class="form-group">
        <label for="equipo_id">Equipo</label>
        <input type="number" name="equipo_id" class="form-control" id="equipo" value="" required placeholder="Equipo">
    </div>
    <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" class="form-control" id="descripcion"  placeholder="Descripcion">
    </div>
    <input type="submit" class="btn btn-primary btn-lg" value="Guardar">
 
</form>