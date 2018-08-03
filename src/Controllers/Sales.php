<?php
namespace Controllers;

use Models\SalesModel;

class Sales extends Controller {

	private $sales;

	function __construct() {
		parent::__construct();
		$this->sales = new SalesModel();
	}

	public function index() {

		$data = $this->sales->read();

		$this->view->render($data);
	}

	public function createsales() {

		$this->sales->createSalesTable();

	}

	public function salesform() {

		$data['sale_date'] = '';
		$data['sale_price'] = '';

		$error = false;
		$errors = [
			'sale_date' => '', 'sale_price' => ''
		];
		$content = [];
		$invalid = 'is-invalid';
		$valid = 'is-valid';

		if (!empty($_POST)) {

			$data = $_POST;

			if (!is_numeric($_POST['realestate_id'])) {
				echo "Property does not exists.";
				exit();
			}

			if ( !preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $_POST['sale_date']) ){
				$error = true;
				$errors['sale_date'] = $invalid;
			} else {
				$errors['sale_date'] = $valid;
			}

			if (!is_numeric($_POST['sale_price'])) {
				$error = true;
				$errors['sale_price'] = $invalid;
			} else {
				$errors['sale_price'] = $valid;
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

		$content = ['error' => $error, 'data' => $data, 'errors' => $errors];

		$this->view->render($content);
	}

	public function createsuccess() {

		$this->view->render();
	}

	public function min() {
		$data = $this->sales->min();
		echo json_encode($data[0]);
	}

	public function max() {
		$data = $this->sales->max();
		echo json_encode($data[0]);
	}

}
