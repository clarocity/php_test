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

		$data = [];
		$realestate_id = 0;
		if (!empty($_GET['realestate_id'])) {
			if (is_numeric($_GET['realestate_id'])) {
				$realestate_id = $_GET['realestate_id'];

				$data = $this->realestate->read($realestate_id);
			}
		}
		$this->view->render($data);
	}

	public function createproperties() {

		$this->realestate->createPropertiesTable();

	}

	public function propertyForm($post_url, $input, $type, $success, $data) {

		$error = false;
		$errors = [
			'first_name' => '', 'last_name' => '', 'address' => '', 
			'city' => '', 'state' => '', 'zip' => ''
		];
		$content = [];
		$invalid = 'is-invalid';
		$valid = 'is-valid';

		if (!empty($_POST)) {
			// Use hash_equals after php 7
	    	if ($_SESSION[$type] != $_POST['csrf_token']) {
		    	error_log("Possible csrf attack.");
		        header("Location: http://" . $_SERVER['SERVER_NAME'] . $post_url);
		        exit();
		    }

			$data = $_POST;
			
			if (!ctype_alpha($_POST['first_name'])) {

				$error = true;
				$errors['first_name'] = $invalid;
			} else {
				$errors['first_name'] = $valid;
			}

			if (!ctype_alpha($_POST['last_name'])) {

				$error = true;
				$errors['last_name'] = $invalid;
			} else {
				$errors['last_name'] = $valid;
			}

			if (preg_match('/[^a-zA-Z0-9,.\-\# ]/', $_POST['address']) ) {

				$error = true;
				$errors['address'] = $invalid;
			} else {
				$errors['address'] = $valid;
			}

			if ( preg_match('/[^a-zA-Z\s]/', $_POST['city']) ) {

				$error = true;
				$errors['city'] = $invalid;
			} else {
				$errors['city'] = $valid;
			}

			if (!ctype_alpha($_POST['state'])) {

				$error = true;
				$errors['state'] = $invalid;
			} else {
				$errors['state'] = $valid;
			}

			if (!preg_match('/^\d{5}$/', $_POST['zip'])) {

				$error = true;
				$errors['zip'] = $invalid;
			} else {
				$errors['zip'] = $valid;
			}

			if (!$error) {

				// Add data to Db
				$this->realestate->$type($data);
				unset($_SESSION[$type]);
				header("Location: http://" . $_SERVER['SERVER_NAME'] . "/Realestate/$success");
			}

		}
		$data['csrf_token'] = (empty($_SESSION[$type]))? '': $_SESSION[$type];
		$data['post_url'] = $post_url;
		$data['realestate_input'] = $input;

		$content = ['error' => $error, 'data' => $data, 'errors' => $errors];

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

		$this->csrf($type);
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

		$data['first_name'] = (empty($row[0]['first_name'] ) )? '': $row[0]['first_name'];
		$data['last_name'] = (empty($row[0]['last_name'] ) )? '': $row[0]['last_name'];
		$data['address'] = (empty($row[0]['address'] ) )? '': $row[0]['address'];
		$data['city'] = (empty($row[0]['city'] ) )? '': $row[0]['city'];
		$data['state'] = (empty($row[0]['state'] ) )? '': $row[0]['state'];
		$data['zip'] = (empty($row[0]['zip'] ) )? '': $row[0]['zip'];
		$data['realestate_id'] = $realestate_id;

		$post_url = "/Realestate/update?realestate_id=$realestate_id";
		$input = "<input type='hidden' name='realestate_id' value='$realestate_id'>";
		$type = "update";
		$success = "updatesuccess";

		$this->csrf($type);
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

	public function csrf($token_type) {

		// This is for php versions below 7
		if (empty($_SESSION[$token_type])) {
		    if (function_exists('mcrypt_create_iv')) {
		        $_SESSION[$token_type] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
		    } else {
		        $_SESSION[$token_type] = bin2hex(openssl_random_pseudo_bytes(32));
		    }
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
