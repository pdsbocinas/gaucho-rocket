<div class="w3-container">
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
      <div class="w3-center"><br>
        <!--<span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Cerrar">×</span>-->
        <!--<img src="img_avatar4.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">-->
        <?php
          if (isset($_SESSION['nombre_de_usuario'])) {
            echo "Bienvenido:" . $_SESSION['nombre_de_usuario'] . "";
          } else {
            include("form.php");
            echo "<p>" .$data. "</p>";
          }
        ?>

      </div>
    </div>
  </div>
</div>