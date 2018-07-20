<?php
namespace Controllers;

use Views\View;

class Controller {

	public $view;

	function __construct() {
		$this->view = new View();
	}
}