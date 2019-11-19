<div class="container">
  <?php
    if (isset($data)) {
      echo "<h2>Mis Reservas</h2>";
      foreach ($data as $fila) {
        include($path->getPage("view", "micuenta/components/view_item_reservas.php"));
      }
    }
  ?>
</div>