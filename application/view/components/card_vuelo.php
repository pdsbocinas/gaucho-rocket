<div class="card m-4 server" style="width: 18rem;">
  <img class="card-img-top" src="https://estaticos.muyinteresante.es/media/cache/760x570_thumb/uploads/images/pyr/55520750c0ea197b3fd513ef/luna-azul_1.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php echo $fila['titulo'] ?></h5>
    <p class="card-text"><?php echo $fila['descripcion'] ?></p>
    <strong>$ <?php echo $fila['precio'] ?></strong>
    <a href="reservas?id=<?php echo $fila['id'] ?>" class="btn btn-primary">Reserva</a>
  </div>
  <?php 
      if (isset($_SESSION['rol']) && $_SESSION['rol'] == "admin") { 
        ?>
        <a href="<?php echo  $path->getEvent('admin','editarVuelo'); ?>?id=<?php echo $fila['id'] ?>">Editar</a>     
        <a href="<?php echo  $path->getEvent('admin','eliminarVuelo'); ?>?id=<?php echo $fila['id'] ?>">Eliminar</a>
    <?php } ?>
</div>