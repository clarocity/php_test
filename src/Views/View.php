<?php
namespace Views;

class View {

	private $layout;

	public function render($content = '') {

		$request = $_SERVER['REQUEST_URI']; 
		$request = parse_url($request);
		$request = $request['path'];
		$request = explode("/", $request);

		$class = (empty($request[1]))? 'Index' : $request[1];
		$func = (empty($request[2]))? 'index' : $request[2];

		include("layout.php");

	}
}