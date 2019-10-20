<div class="container">
  <?php 
    foreach ($data as $fila) {
      include($path->getPage("view", "components/card_vuelo.php"));
    }
  ?>
</div>