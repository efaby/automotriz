<?php 	
	define('HOSTNAME_DATABASE', 'localhost');
	define('USERNAME', 'root');
	define('PASSWORD', '123456');
	define('DATABASE', 'automotriz'); 	 
	define('URL_BASE', '/automotriz/');
	define('PATH_MODELOS', PATH_ROOT."/models");
	define('PATH_CONTROLADORES', PATH_ROOT."/controllers");
	define('PATH_VISTAS', PATH_ROOT."/views");
	define('PATH_BASE', "/automotriz");
	define('PATH_CSS', PATH_BASE."/public/web/css");
	define('PATH_JS', PATH_BASE."/public/web/js");
	define('PATH_IMAGES', PATH_BASE."/public/web/images");
	define('PATH_TEMPLATE', PATH_ROOT."/public/template");	
	
	define('PATH_IMAGES_USER',  "../../assets/images/users/");
	define('PATH_FILES_USER',  "../../files/");	
	
	define('PATH_FILES', PATH_ROOT."/public/web/files/");
	define('PATH_FILES_IMAGE', PATH_ROOT."/web/assets/images/users/");
	define('PATH_HELPERS', PATH_ROOT."/libs");	
	define('PUBLIC_URLS', serialize(array('Seguridadmostrar','APIAPIRest','Seguridadvalidar','Seguridaderror404','Seguridaderror403','Seguridaderror500')));
	
?>