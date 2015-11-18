<?php
require ('include/config.php');

$vars = array();
if (isset($_SERVER['PATH_INFO'])) {
	$request = trim($_SERVER['PATH_INFO'], '/');
	$vars = explode('/', $request);
}

if (!isset($vars[0]) || empty($vars[0])) {
	$controller = 'C_Index';
} else {
	$controller = 'C_'.ucfirst($vars[0]);
}

if (!isset($vars[1]) || empty($vars[1])) {
	$function = 'index';
} else {
	$function = $vars[1];
}

$c = new $controller();
$c->$function();

//var_dump($get_vars);

?>