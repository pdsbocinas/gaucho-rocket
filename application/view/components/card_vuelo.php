<div class="card card-vuelos-height m-3 server" style="width: 18rem; float:left;">
  <img class="card-img-top" src="<?php echo $path->getLink("images", $fila['ruta']) ?>" class="card-img-top" alt="...">
  <div class="d-flex flex-column card-body">
    <h5 class="card-title"><?php echo $fila['titulo'] ?></h5>
    <p class="card-text"><?php echo $fila['descripcion'] ?></p>
    <strong class="mb-2">$ <?php echo $fila['precio'] ?></strong>
    <a href="<?php echo $path->getEvent('reservas','') ?>?id=<?php echo $fila['id'] ?>" class="btn btn-primary">Reserva</a>
    <?php 
    if (isset($_SESSION['rol']) && $_SESSION['rol'] == "admin") { 
      echo "<div class='d-flex flex-row justify-content-start mt-2'>";
      echo "<a class='btn btn-primary mr-2' href=".$path->getEvent('admin','editarVuelo')."?id=".$fila['id'].">Editar</a>";
      echo "<a class='btn btn-danger' href=".$path->getEvent('admin','eliminarVuelo')."?id=".$fila['id'].">Eliminar</a>";
      echo "</div>";
    }

    ?>
  </div>
</div>