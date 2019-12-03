<div class="container">
  <?php
    if (isset($_SESSION['userId']) && ($data['disponibilidad'] and is_null($_SESSION['userId']))) {
      include($path->getPage("view", "components/form_reservas.php"));
      echo "<p class='mt-2'>Ingresa o registrate para podes reservar</p>";
    } else if(!$data['disponibilidad']) {
      echo  "<form method='POST' class='confirm_lista_espera'>";
      echo "<input type='hidden' name='usuario' value=".$_SESSION['userId']." />";
      echo "<input type='hidden' name='vuelo' value=".$data[0]['id'].">";
      if (is_null($_SESSION['userId'])) {
        echo "<button type='reset' data-toggle='modal' data-target='#exampleModal' class='btn btn-primary white trigger-modal'>Anotarme en lista de espera</button>";
      } else {
        echo "<button type='submit' class='btn btn-primary'>Anotarme en lista de espera</button>";
      }
      echo "</form>";
      
      include($path->getPage("view", "components/toast_success.php"));
    } else {
      include($path->getPage("view", "components/form_reservas.php"));
    }
  ?>
</div>