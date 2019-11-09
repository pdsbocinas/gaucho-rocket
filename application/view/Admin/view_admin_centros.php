<div class="card" style="width: 18rem;">
  
  <div class="card-body">
    <a href="<?php echo  $path->getEvent('admin','altaCentro'); ?>">alta centro</a> 
       <!-- <a href="" class="btn btn-primary stretched-link">AGREGAR UN CENTRO</a> -->
  </div>
</div>
</div>
<div class="container">
  <?php
    foreach ($data as $fila) {
      include($path->getPage("view", "components/card_centros.php"));
    }
    ?>  
</div>
