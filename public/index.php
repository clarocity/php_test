<?php

define('SRC', '..'. DIRECTORY_SEPARATOR .'src' . DIRECTORY_SEPARATOR);
set_include_path(SRC);
spl_autoload_register();

try {
	$request = $_SERVER['REQUEST_URI']; 
	$request = parse_url($request);
	$request = $request['path'];
	$request = explode("/", $request);

	$controller = $request[1];
	$control = "Controllers\\".$controller;
	if(class_exists($control)) {

		$control = new $control;

	} else {

		$error = "class " . $control . " not found.<br />";
		throw new Exception($error);
	}
	
	
	$action = $request[2];
	if(!method_exists($control, $action)) {

		$error = "Method " . $action . " does not exists.<br />";
		throw new Exception($error);
	}


	$control->$action();

} catch (Exception $e) {

	error_log('Caught exception: ' .  $e->getMessage() . "\n");
	exit();
}

?>




<!DOCTYPE html>
<html>

	<head>
		<title>Test</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

	    <link rel="stylesheet" href="bootstrap-4.1.2-dist/css/bootstrap.min.css"/>

    	<script src="jquery/jquery-3.3.1.min.js"></script>
    	<script src="bootstrap-4.1.2-dist/js/bootstrap.min.js"></script>
	</head>

<body>
The content of the document......
</body>

</html>
