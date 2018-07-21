<?php
setlocale(LC_MONETARY, 'en_US.UTF-8');

define('SRC', '..'. DIRECTORY_SEPARATOR .'src' . DIRECTORY_SEPARATOR);
set_include_path(SRC);
spl_autoload_register();

$request = $_SERVER['REQUEST_URI']; 
$request = parse_url($request);
$request = $request['path'];
$request = explode("/", $request);

try {

	$controller = (empty($request[1]))? 'Index' : $request[1];
	$action = (empty($request[2]))? 'index' : $request[2];

	$control = "Controllers\\".$controller;

	if(class_exists($control)) {

		$control = new $control;
	}
	
	if(method_exists($control, $action)) {

		$control->$action();
	} else {

		throw new Exception('method not found.');
	}


} catch (Exception $e) {

	if (!empty($e->getMessage())) {
		error_log("Caught exception: " . $e->getMessage());
	}
	
	header("Location: http://" . $_SERVER['SERVER_NAME'] . "/");
}

