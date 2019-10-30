<div class="card" style="width: 18rem;">  
<form action="" method="get">
<img src="https://estaticos.muyinteresante.es/media/cache/760x570_thumb/uploads/images/pyr/55520750c0ea197b3fd513ef/luna-azul_1.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title" name='id'><?php echo $fila['id'] ?></h5>
    <p class="card-text" name='nombre'><?php echo $fila['nombre'] ?></p>
    <p class="card-text" name='ubicacion'><?php echo $fila['ubicacion'] ?></p>
    <input type="hidden" value='<?php echo $fila['id'] ?>' name='id' />
    
  </div>
  </form>
</div>