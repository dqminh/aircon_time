<?php
/* Aircon Test cases generated on: 2010-05-22 12:05:32 : 1274503532*/
App::import('Model', 'Aircon');

class AirconTestCase extends CakeTestCase {
	var $fixtures = array('app.aircon', 'app.user');

	function startTest() {
		$this->Aircon =& ClassRegistry::init('Aircon');
	}

	function endTest() {
		unset($this->Aircon);
		ClassRegistry::flush();
	}

}
?>
