<div class="container">
  <?php
    foreach ($data as $fila) {
      echo "
        <ul>
          <li>{$fila['total']}</li>
        <ul>
      ";
    }
  ?>
</div>