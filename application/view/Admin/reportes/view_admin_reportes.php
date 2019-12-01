<div class="container">
  <ul class="d-flex list-group">
    <li class="list-group-item border-0">
      <a href=<?php echo $path->getEvent('admin', 'tasaOcupacionPorViajeyEquipo') ?> target="_blank"  class="btn btn-primary">Tasa de ocupacion y equipo</a>
    </li>
    <li class="list-group-item border-0">
      <a href=<?php echo $path->getEvent('admin', 'obtenerFacturacionPorMes') ?> target="_blank" class="btn btn-primary">Facturacion Mensual</a>
    </li>
    <li class="list-group-item border-0">
      <a href="<?php echo $path->getEvent('admin', 'cabinaMasVendida') ?>" target="_blank"  class="btn btn-primary">Cabina mas vendida</a>
    </li>
    <li class="list-group-item border-0">
      <a href="<?php echo $path->getEvent('admin', 'facturacionPorUsuario') ?>" target="_blank"  class="btn btn-primary">Facturacion por usuario</a>
    </li>
  </ul>
</div>