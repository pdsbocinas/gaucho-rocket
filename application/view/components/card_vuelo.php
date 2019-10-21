<div class="card" style="width: 18rem;">
  <img src="https://estaticos.muyinteresante.es/media/cache/760x570_thumb/uploads/images/pyr/55520750c0ea197b3fd513ef/luna-azul_1.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php echo $fila['titulo'] ?></h5>
    <p class="card-text"><?php echo $fila['descripcion'] ?></p>
    <a href="reservas?id=<?php echo $fila['id'] ?>" class="btn btn-primary">Reserva</a>
  </div>
</div>