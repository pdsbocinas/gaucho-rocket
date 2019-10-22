<div class="container">
  <?php
    var_dump($data);
    foreach ($data as $fila) {
      include($path->getPage("view", "components/form_reservas.php"));
    }
  ?>
</div>