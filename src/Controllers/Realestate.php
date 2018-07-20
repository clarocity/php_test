<?php
namespace Controllers;

use Models\Sales;

class Realestate extends Controller {

	private $sales;

	function __construct() {
		parent::__construct();
		$this->sales = new Sales();
	}

	public function index() {

		echo 'Index found in Realestate';
	}

	public function createproperties() {

		$this->sales->createPropertiesTable();

	}

	public function addressform() {

		$data['first_name'] = '';
		$data['last_name'] = '';
		$data['address'] = '';
		$data['city'] = '';
		$data['state'] = '';
		$data['zip'] = '';

		$error = false;
		$content = [];

		if (!empty($_POST)) {

			$data = $_POST;
			
			if (!ctype_alpha($_POST['first_name'])) {

				$error = true;
				$data['first_name'] = '';
			}

			if (!ctype_alpha($_POST['last_name'])) {

				$error = true;
				$data['last_name'] = '';
			}

			if (preg_match('/[^a-zA-Z0-9,.\-\# ]/', $_POST['address'])) {

				$error = true;
				$data['address'] = '';
			}

			if (!ctype_alpha($_POST['city'])) {

				$error = true;
				$data['city'] = '';
			}

			if (!ctype_alpha($_POST['state'])) {

				$error = true;
				$data['state'] = '';
			}

			if (!preg_match('/^\d{5}$/', $_POST['zip'])) {

				$error = true;
				$data['zip'] = '';
			}

			if (!$error) {

				// Add data to Db

				header("Location: http://" . $_SERVER['SERVER_NAME'] . "/Realestate/formsuccess");
			}

		}

		$content = ['error' => $error, 'data' => $data];

		$this->view->render($content);
	}

	public function formsuccess() {

		echo "Thank you for submitting a proper form.";
	}

	public function create() {

	}

	// public function read() {

	// }

	// public function update() {

	// }

	// public function delete() {

	// }

}
