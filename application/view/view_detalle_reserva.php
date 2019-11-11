<div class="container">
  <?php
    foreach ($data as $fila) {
      include($path->getPage("view", "components/form_reservas.php"));
    }
  ?>
</div>