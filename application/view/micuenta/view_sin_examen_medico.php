<div class="container">
  <div class="row mt-4">
  <?php
    foreach ($data as $fila) {
      echo "<div class='card col-md-4 mr-3' style='width: 18rem;'>";
      include($path->getPage("view", "components/card_centros.php"));
      echo "<a id=centro-". $fila['id'] ." href='javascript:void(0)' class='btn btn-primary centro-medico'>Pedir turno</a>";
      echo "</div>";
    }
  ?>
  </div>
</div>