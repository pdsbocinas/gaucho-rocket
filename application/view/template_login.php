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
<style>
    html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body onload="document.getElementById('id01').style.display='block'" class="w3-light-grey">
<!-- !PAGE CONTENT! -->
<?php
    require_once($path->getPage("view",$content_view)); 
?>
<!-- !END PAGE CONTENT! -->
</body>
</html>

