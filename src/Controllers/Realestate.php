<?php
namespace Controllers;


use Models\RealestateModel;

class Realestate extends Controller {

	private $realestate;

	function __construct() {
		parent::__construct();

		$this->realestate = new RealestateModel();
	}

	public function index() {

		$realestate_id = 0;
		if (is_numeric($_GET['realestate_id'])) {
			$realestate_id = $_GET['realestate_id'];
		} else {
			echo "Property does not exists.";
			exit();
		}
		
		$data = $this->realestate->read($realestate_id);

		$this->view->render($data);
	}

	public function createproperties() {

		$this->realestate->createPropertiesTable();

	}

	public function propertyForm($post_url, $input, $type, $success, $data) {

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

			if (preg_match('/[^a-zA-Z0-9,.\-\# ]/', $_POST['address']) ) {

				$error = true;
				$data['address'] = '';
			}

			if ( preg_match('/[^a-zA-Z\s]/', $_POST['city']) ) {

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
				$this->realestate->$type($data);

				header("Location: http://" . $_SERVER['SERVER_NAME'] . "/Realestate/$success");
			}

		}

		$data['post_url'] = $post_url;
		$data['realestate_input'] = $input;

		$content = ['error' => $error, 'data' => $data];

		return $content;
	}

	public function create() {

		$data['first_name'] = '';
		$data['last_name'] = '';
		$data['address'] = '';
		$data['city'] = '';
		$data['state'] = '';
		$data['zip'] = '';
		$post_url = "/Realestate/create";
		$input = "";
		$type = "create";
		$success =  "createsuccess";
		$content = $this->propertyForm($post_url, $input, $type, $success, $data);

		$this->view->render($content);
	}

	public function update() {

		$data = [];

		$realestate_id = 0;
		if (is_numeric($_GET['realestate_id'])) {
			$realestate_id = $_GET['realestate_id'];
		} else {
			echo "Property does not exists.";
			exit();
		}

		$row = $this->realestate->read($realestate_id);

		$data['first_name'] = $row[0]['first_name'];
		$data['last_name'] = $row[0]['last_name'];
		$data['address'] = $row[0]['address'];
		$data['city'] = $row[0]['city'];
		$data['state'] = $row[0]['state'];
		$data['zip'] = $row[0]['zip'];

		$post_url = "/Realestate/update?realestate_id=$realestate_id";
		$input = "<input type='hidden' name='realestate_id' value='$realestate_id'>";
		$type = "update";
		$success = "updatesuccess";
		$content = $this->propertyForm($post_url, $input, $type, $success, $data);

		$this->view->render($content);
	}

	public function delete() {

		$realestate_id = 0;
		if (is_numeric($_POST['realestate_id'])) {

			$realestate_id = $_POST['realestate_id'];
			$this->realestate->delete($realestate_id);

			header("Location: http://" . $_SERVER['SERVER_NAME'] . "/Realestate/deletedsuccess");			
		} else {
			echo "Property does not exists.";
			exit();
		}
	}

	public function createsuccess() {

		$this->view->render();
	}

	public function updatesuccess() {

		$this->view->render();
	}

	public function deletedsuccess() {

		$this->view->render();
	}

}
