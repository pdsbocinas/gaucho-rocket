<div class="container">
  <?php
    if(is_string($data)) {
      echo "<p>" . $data . "</p><br>";
      echo "<a href=" . $path->getEvent('micuenta', 'examenes') .  ">Ir a mis examenes</a>";
    }
    if (isset($data)) {
      foreach ($data as $fila) {
        include($path->getPage("view", "components/form_reservas.php"));
      }
    }
  ?>
</div>