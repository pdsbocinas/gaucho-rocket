<div class="card" style="width: 18rem;">
  <img src="https://estaticos.muyinteresante.es/media/cache/760x570_thumb/uploads/images/pyr/55520750c0ea197b3fd513ef/luna-azul_1.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php echo $fila['id'] ?></h5>
    <p class="card-text"><?php echo $fila['ubicacion'] ?></p>
    <p class="card-text"><?php echo $fila['nombre'] ?></p>
    
  </div>
  <?php 
    if ($_SESSION['rol'] == "admin") {
      echo "<a href=''>Editar</a>";
    }
  ?>
</div>