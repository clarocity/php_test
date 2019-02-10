<?php
namespace Controllers;

use Models\RealestateModel;

class Index extends Controller {

	private $sales;
	private $realestate;

	function __construct() {
		parent::__construct();

		$this->realestate = new RealestateModel();
	}

	public function index() {

		$data = $this->realestate->readAll();

		$this->view->render($data);
	}
}