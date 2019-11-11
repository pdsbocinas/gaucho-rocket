<div class="container">
    <h1>Centros</h1>
  <?php
    foreach ($data as $fila) {
      include($path->getPage("view", "components/card_centros.php"));
    }
  ?>
</div>

