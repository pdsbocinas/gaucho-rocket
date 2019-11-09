<div class="container">
  <?php
    if (isset($data)) {
      foreach ($data as $fila) {
        include($path->getPage("view", "components/form_reservas.php"));
      }
    }
  ?>
</div>