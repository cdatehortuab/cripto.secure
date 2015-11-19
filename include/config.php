<?php
session_start();

define('PROJECT_NAME', 'cripto.secure');
define('PATH_GLOBAL', $_SERVER['DOCUMENT_ROOT'].PROJECT_NAME.'/');
define('LINK_GLOBAL', ((empty($_SERVER['HTTPS']))? 'http://' : 'https://').
	$_SERVER['SERVER_NAME'].
	(($_SERVER['SERVER_PORT'] != '80' && $_SERVER['SERVER_PORT'] != 443)?
	':'.$_SERVER['SERVER_PORT'] : '').'/'.PROJECT_NAME.'/');
define('CONTROLLERS_PATH', PATH_GLOBAL.'controllers/');
define('VIEWS_PATH', PATH_GLOBAL.'views/');
define('CLASSES_PATH', PATH_GLOBAL.'classes/');

define('MYSQL_HOST', 'sql5.freemysqlhosting.net');
define('MYSQL_USER', 'sql596927');
define('MYSQL_PASS', 'pS3!bD3*');
define('MYSQL_DBNAME', 'sql596927');
define('MYSQL_PORT', 3306);

function autoload($class_name) {
	if(is_file(CLASSES_PATH.$class_name.".php")) {
		include_once(CLASSES_PATH.$class_name.".php");
	} else if (is_file(CONTROLLERS_PATH.$class_name.".php")) {
		include_once(CONTROLLERS_PATH.$class_name.".php");
	} else {
		header('Location:'.LINK_GLOBAL);
	}
}
spl_autoload_register("autoload");

?>