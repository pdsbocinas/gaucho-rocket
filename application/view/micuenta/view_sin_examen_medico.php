<div class="container">
  <div class="row">
  <?php
    foreach ($data as $fila) {
      echo "<div class='col-md-4'>";
      include($path->getPage("view", "components/card_centros.php"));
      echo "<a id=centro-". $fila['id'] ." class='centro-medico'>Pedir turno</a>";
      echo "</div>";
    }
  ?>
  </div>
</div>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.centro-medico').on('click', function(e) {
      const regexOnlyNumber = new RegExp('([0-9.,]+)', 'g');
      const getId = this.id.match(regexOnlyNumber).shift();
      $.ajax({
        type: "POST",
        url: "<?php echo $path->getEvent('micuenta', 'crearTurno') ?>",
        data: { centro_id: getId },
        success: function(response) {
          var link =  "<?php echo $this->path->getEvent('micuenta', 'examenes') ?>";
          window.location.href = link
        }
      })
    })
  });
</script>