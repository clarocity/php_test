<?php
namespace Controllers;

use Models\Sales;
use Views\View;

class Realestate {

	private $sales;
	private $view;

	function __construct() {
		$this->sales = new Sales();
		$this->view = new View();
	}

	public function index() {

		echo 'Index found in Realestate';
	}

	public function Helloworld() {

		$amounts = $this->sales->getAmounts();

		$this->view->render($amounts);
	}

	public function createproperties() {

		$this->sales->createPropertiesTable();

	}

	public function create() {

	}

	public function read() {

	}

	public function update() {

	}

	public function delete() {

	}

}
