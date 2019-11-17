<div class="container">
  <?php
    if ($data['disponibilidad']) {
      include($path->getPage("view", "components/form_reservas.php"));
    }
    if (!$data['disponibilidad']) {
      echo $data['mensaje'];
      echo 
      "<form method='POST' class='confirm_lista_espera'>
        <input type='hidden' name='usuario' value=".$_SESSION['id']." />
        <input type='hidden' name='vuelo' value=".$data[0]['id'].">
        <button type='submit' class='btn btn-primary'>Anotarme en lista de espera</button>
      </form>";
      include($path->getPage("view", "components/toast_success.php"));
    }
  ?>
</div>