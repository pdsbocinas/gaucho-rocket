<!DOCTYPE html>
<html>
<title>Sistema de Documentaci&oacute;n</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
$path = Path::getInstance("config/path.ini");
//echo "<link rel='stylesheet' href='" . $path->getLink("css","w3.css") . "'>";
// echo "<link rel='stylesheet' href='" . $path->getLink("css","fontawesome-free-5.9.0-web/css/all.css") . "'>"; ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>


<?php echo "<link rel='stylesheet' href='" . $path->getLink("css","header.css") . "'>"; ?>
<?php echo "<link rel='stylesheet' href='" . $path->getLink("css","reservas.css") . "'>"; ?>
<?php echo "<link rel='stylesheet' href='" . $path->getLink("css","buscador.css") . "'>"; ?>
<?php echo "<link rel='stylesheet' href='" . $path->getLink("css","checkin.css") . "'>"; ?>


<style>
    html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
  <body class="w3-light-grey">
    <!-- !PAGE CONTENT! -->
    <?php 
        include($path->getPage("view", "Header/header.php")) 
    ?>
    <?php
        require_once($path->getPage("view", $content_view));
    ?>
    <?php 
        include($path->getPage("view", "Footer/footer.php")) 
    ?>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registrate</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <?php 
            include($path->getPage("view", "Header/form-register.php")) 
          ?>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <!-- !END PAGE CONTENT! -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <?php echo "<script src=" . $path->getLink("js", "login.js") . "></script>" ?>
    <?php echo "<script src=" . $path->getLink("js", "registrarTurno.js") . "></script>" ?>
    <?php echo "<script src=" . $path->getLink("js", "gestionarReserva.js") . "></script>" ?>
    <?php echo "<script src=" . $path->getLink("js", "buscarVuelos.js") . "></script>" ?>
    <?php echo "<script src=" . $path->getLink("js", "traerAsientosOcupadosYDisponibles.js") . "></script>" ?>
    <?php echo "<script src=" . $path->getLink("js", "anotarListaEspera.js") . "></script>" ?>
  </body>
</html>

