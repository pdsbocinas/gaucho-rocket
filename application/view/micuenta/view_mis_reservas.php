<div class="container">
  <?php
    if (isset($data)) {
      foreach ($data as $fila) {
        include($path->getPage("view", "micuenta/components/view_item_reservas.php"));
      }
    }
    ?>

    <a href="<?php  echo $path->getEvent('micuenta', 'checkin');?>">Realizar Checkin</a>;
</div>