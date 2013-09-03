<?php
session_start();

date_default_timezone_set('America/Los_Angeles');
define('APP_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../app');
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST']);

require_once APP_PATH . '/ConfigIni.php';
require_once APP_PATH . '/Request.php';
require_once APP_PATH . '/DataMapper.php';
require_once APP_PATH . '/Router.php';
require_once APP_PATH . '/SimpleController.php';

$request = new Request();
$routes = new Router();
$controller = new SimpleController();
$controller->run($routes->getControllerAction($request->getAction()));

?>
