<div class="card-body">
    <a href="<?php echo  $path->getEvent('admin','altaVuelos'); ?>">alta vuelo</a> 
       <!-- <a href="" class="btn btn-primary stretched-link">AGREGAR UN CENTRO</a> -->
  </div>
<div class="container">
  <?php
    foreach ($data as $fila) {
      include($path->getPage("view", "components/card_vuelo.php"));
    }
  ?>
</div>