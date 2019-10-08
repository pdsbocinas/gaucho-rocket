<?php
session_start();



require_once("./core/helpers/Path.php");
$path = Path::getInstance("config/path.ini");
// Incluyo el CORE del MVC



require_once( $path->getPage("core", "Model.php") );
require_once( $path->getPage("core", "View.php") );
require_once( $path->getPage("core", "Controller.php") );
require_once( $path->getPage("core", "Router.php") );

// Incluyo los helpers (clases comunes a todo el proyecto)
require_once( $path->getPage("helpers", "Date.php") );
require_once( $path->getPage("helpers", "Log.php") );
require_once( $path->getPage("helpers", "Database.php") );


require_once("./core/helpers/Config.php");
$config = Config::init("./config/config.ini");

// Configuracion de la zona horaria
date_default_timezone_set( Config::getParam("time", "timezone") );
// Prevengo el uso de iframes fuera del dominio del sistema
header("X-Frame-Options: SAMEORIGIN");
$router = new Router($_SERVER['REQUEST_URI']);
$router->start();
