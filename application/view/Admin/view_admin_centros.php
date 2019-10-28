<div class="container">
  <?php
    foreach ($data as $fila) {
      include($path->getPage("view", "components/card_centros.php"));
    }
    ?>  
</div>
<button class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Agregar Centro</button>