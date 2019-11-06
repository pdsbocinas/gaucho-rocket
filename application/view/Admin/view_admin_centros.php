<a href="" class="btn btn-primary stretched-link">Nuevo Centro</a>
<div class="container">
  <?php
    foreach ($data as $fila) {
      include($path->getPage("view", "components/card_centros.php"));
    }
    ?>  
</div>
