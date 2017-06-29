<?php
define("PATH_ROOT", __DIR__);

require_once(PATH_ROOT . "/config/params.inc");


session_start();
if(isset($_GET['action'])){
	$redirect = ($_GET['action']!='')?$_GET['action']:"listar";
	$url = "?action=".$redirect;
}
 
if(!isset($app)){
	$app = 'Seguridad';
	$redirect = "mostrar";
}	
$urls = unserialize(PUBLIC_URLS);

if (!isset($_SESSION['SESSION_USER'])){
	if(!in_array($app.$redirect, $urls)){
		header("location: ".URL_BASE);
		exit();
	}
}


require_once(PATH_CONTROLADORES."/".$app."Controlador.php");
$controllerName = $app."Controlador";
$controller = new $controllerName();
$controller->$redirect();

?>