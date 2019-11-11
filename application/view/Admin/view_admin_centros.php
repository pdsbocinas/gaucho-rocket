<div class="card" style="width: 18rem;">
  
  <div class="card-body">
    <a href="<?php echo  $path->getEvent('admin','altaCentro'); ?>">alta centro</a> 
  </div>
</div>
<div class="container d-flex  flex-wrap justify-content-around">
  <?php
    foreach ($data as $fila) {
      include($path->getPage("view","components/card_centros.php"));
    }
    ?>  
</div>
