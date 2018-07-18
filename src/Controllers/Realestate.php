<?php
namespace Controllers;

use Models\Sales;

class Realestate {

	public function Helloworld() {

		$sales = new Sales();
		echo $sales->getAmounts();

	}

}
