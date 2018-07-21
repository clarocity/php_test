<?php
namespace Controllers;

use Models\SalesModel;
use Models\RealestateModel;

class Sales extends Controller {

	private $sales;
	private $realestate;

	function __construct() {
		parent::__construct();
		$this->sales = new SalesModel();
		$this->realestate = new RealestateModel();
	}

	public function createsales() {

		$this->sales->createSalesTable();

	}

	 public function salesform() {

		$data['sale_date'] = '';
		$data['sale_price'] = '';

		$error = false;
		$content = [];

		if (!empty($_POST)) {

			$data = $_POST;

			if (!is_numeric($_POST['realestate_id'])) {
				echo "Property does not exists.";
				exit();
			}

			if ( !preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $_POST['sale_date']) ){
				$error = true;
				$data['sale_date'] = '';
			}

			if (!is_numeric($_POST['sale_price'])) {
				$error = true;
				$data['sale_price'] = '';
			}

			if (!$error) {

				$this->sales->create($data);

				header("Location: http://" . $_SERVER['SERVER_NAME'] . "/Sales/createsuccess");
			}

		} else {
			if (is_numeric($_GET['realestate_id'])) {	
				$data['realestate_id'] = $_GET['realestate_id'];
			} else {
				echo "Property does not exists.";
				exit();
			}
		}

		$content = ['error' => $error, 'data' => $data];

		$this->view->render($content);
	 }

	public function createsuccess() {

		$this->view->render();
	}
}
