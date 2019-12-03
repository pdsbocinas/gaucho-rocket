<div class="container">
  <ul class="d-flex list-group">
   
    </form>
    <li class="list-group-item border-0">
      <a href=<?php echo $path->getEvent('admin', 'tasaOcupacionPorViajeyEquipo') ?> target="_blank"  class="btn btn-primary">Tasa de ocupacion y equipo</a>
    </li>
    <li class="list-group-item border-0">
      <form action="<?php echo $path->getEvent('admin', 'obtenerFacturacionPorMes') ?>" class="flex" method="post" target="_blank">
      <label for="desde">Desde:</label>
      <input type="date" name="desde" id="desde">
      <label for="hasta">Hasta:</label>
      <input type="date" name="hasta" id="hasta"> 
      <input type="submit" class="btn btn-primary" value="Facturacion Mensual">
    </form>   
    </li>
    <li class="list-group-item border-0">
      <form action="<?php echo $path->getEvent('admin', 'cabinaMasVendida') ?>" method="post" target="_blank">
      <label for="inicio">Desde:</label>
      <input type="date" name="inicio" id="inicio">
      <label for="inicio">Hasta:</label>
      <input type="date" name="fin" id="fin"> 
      <input type="submit" class="btn btn-primary" value="Cabina mas vendida">
    </form>   
    </li>
    <li class="list-group-item border-0">
      <a href="<?php echo $path->getEvent('admin', 'facturacionPorUsuario') ?>" target="_blank"  class="btn btn-primary">Facturacion por usuario</a>
    </li>
  </ul>
</div>