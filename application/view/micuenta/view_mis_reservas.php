<div class="pl-3 pr-3 mt-4 containe-fluid">
  <?php
    if (isset($data)) {
      echo "<h2>Mis Reservas</h2>";
      foreach ($data as $fila) {
        include($path->getPage("view", "micuenta/components/view_item_reservas.php"));
      }
    }
    include($path->getPage("view", "components/toast_success.php"));
  ?>
</div>