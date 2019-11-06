<div class="card" style="width: 18rem;">  
    <img src="https://estaticos.muyinteresante.es/media/cache/760x570_thumb/uploads/images/pyr/55520750c0ea197b3fd513ef/luna-azul_1.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title" name='id'><?php echo $fila['id'] ?></h5>
    <p class="card-text" name='nombre'><?php echo $fila['nombre'] ?></p>
    <p class="card-text" name='ubicacion'><?php echo $fila['ubicacion'] ?></p>
   
   
   
    <form action="" method="get">
      <input type="hidden" name="id" value='<?php echo $fila['id'] ?>'>
      <input type="hidden" name="nombre" value='<?php echo $fila['nombre'] ?>'>
      <input type="hidden" name="id" value='<?php echo $fila['id'] ?>'>
     
    </div>
    <?php 
      if ($_SESSION['rol'] == "admin") {
        
        $link= $path->getEvent('admin','editarCentro');
        echo"<a href='$link'>Editar</a>";
        
        //echo "<button type='submit'class='btn btn-link'><a href='$link'>Editar</a></button>";
      }
      ?>
      </form>
</div>