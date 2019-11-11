<div class="card m-4" style="width: 18rem;">  
  <img class="card-img-top" src="https://estaticos.muyinteresante.es/media/cache/760x570_thumb/uploads/images/pyr/55520750c0ea197b3fd513ef/luna-azul_1.jpg" class="card-img-top" alt="...">
  <a href="#!"><div class="mask rgba-white-slight"></div></a>
  <div class="card-body">
    <h5 class="card-title" name='id'><?php echo $fila['id'] ?></h5>
    <p class="card-text" name='nombre'><?php echo $fila['nombre'] ?></p>
    <p class="card-text" name='ubicacion'><?php echo $fila['ubicacion'] ?></p>
  
    <?php 
      if ($_SESSION['rol'] == "admin") { 
        ?>
        <a href="<?php echo  $path->getEvent('admin','editarCentro'); ?>?id=<?php echo $fila['id'] ?>">Editar</a>     
        <a href="<?php echo  $path->getEvent('admin','eliminarCentro'); ?>?id=<?php echo $fila['id'] ?>">Eliminar</a>
    <?php } ?>
  </div>
</div>