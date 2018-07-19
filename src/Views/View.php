<?php
namespace Views;

class View {

	private $layout;

	public function render($content = '') {

		$caller = debug_backtrace();
		$details = $caller[1];
		$func = $details['function'];

		$class = $details['class'];
		$class = explode("\\", $class);
		$class = $class[1];

		include("layout.php");

	}
}