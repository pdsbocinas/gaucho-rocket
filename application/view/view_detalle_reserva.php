<div class="container">
  <?php
    if (isset($_SESSION['userId']) && ($data['disponibilidad'] and is_null($_SESSION['userId']))) {
      include($path->getPage("view", "components/form_reservas.php"));
      echo "<p class='mt-2'>Ingresa o registrate para podes reservar</p>";
    } else if(!$data['disponibilidad']) {
      echo 
      "<form method='POST' class='confirm_lista_espera'>
        <input type='hidden' name='usuario' value=".$_SESSION['userId']." />
        <input type='hidden' name='vuelo' value=".$data[0]['id'].">
        <button type='submit' class='btn btn-primary'>Anotarme en lista de espera</button>
      </form>";
      include($path->getPage("view", "components/toast_success.php"));
    } else {
      include($path->getPage("view", "components/form_reservas.php"));
    }
  ?>
</div>