<!DOCTYPE html>
<html>
<title>Sistema de Documentaci&oacute;n</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
$path = Path::getInstance("config/path.ini");
echo "<link rel='stylesheet' href='" . $path->getLink("css","w3.css") . "'>";
echo "<link rel='stylesheet' href='" . $path->getLink("css","fontawesome-free-5.9.0-web/css/all.css") . "'>"; ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
    html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body onload="document.getElementById('id01').style.display='block'" class="w3-light-grey">
<!-- !PAGE CONTENT! -->
<?php 
    include($path->getPage("view", "Header/header.php")) 
?>
<?php
    require_once($path->getPage("view", $content_view));
?>
<!-- !END PAGE CONTENT! -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>

