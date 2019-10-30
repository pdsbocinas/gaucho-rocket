<div class="container">
  <?php
    foreach ($data as $fila) {
      include($path->getPage("view", "components/card_centros.php"));
    }
    ?>  
</div>
<a href="<?php echo $path->getEvent('admin', 'altaCentro'); ?>" class="btn btn-primary stretched-link">Nuevo Centro</a>
