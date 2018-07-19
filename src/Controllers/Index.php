<?php
namespace Controllers;

use Views\View;

class Index {

	private $view;

	function __construct() {
		$this->view = new View();
	}

	public function index() {

		$this->view->render();
	}
}