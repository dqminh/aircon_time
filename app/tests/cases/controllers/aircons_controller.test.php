<?php
/* Aircons Test cases generated on: 2010-05-22 12:05:58 : 1274503558*/
App::import('Controller', 'Aircons');

class TestAirconsController extends AirconsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class AirconsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.aircon', 'app.user');

	function startTest() {
		$this->Aircons =& new TestAirconsController();
		$this->Aircons->constructClasses();
        $this->Aircons->Component->initialize($this->Aircons);
	}

	function endTest() {
		unset($this->Aircons);
		ClassRegistry::flush();
	}

    function testSelect() {
        $this->Aircons->data = array(
            'Aircon' => array('room' => 1)
        );
        $this->Aircons->beforeFilter();
        $this->Aircons->select();
        $id = $this->Aircons->Session->read('User.id');
        $name = $this->Aircons->Session->read('User.name');
        $this->assertEqual($id, 1);
        $this->assertEqual($name, 'FrogBich');
        $this->assertTrue(!empty($this->Aircons->redirectUrl));

        $this->assertEqual($this->Aircons->redirectUrl, array('action' => 'general'));
    }

    function testAddNewEntry() {
        $this->Aircons->data = array(
            'Aircon' => array(
                'start_time' => array('month' => 05, 'day' => 22, 'year' => 2010, 'hour' => 01, 'min' => 27, 'meridian' => 'pm'),
                'end_time' => array('month' => 05, 'day' => 22, 'year' => 2010, 'hour' => 01, 'min' => 27, 'meridian' => 'pm'),
                'user_id' => 1
            )
        );
        $this->Aircons->beforeFilter();
        $this->Aircons->add();
        $entry = $this->Aircons->Aircon->read(null, $this->Aircons->Aircon->id);
        $this->assertEqual($entry['Aircon']['user_id'], 1);
        $this->assertEqual($entry['Aircon']['start_time'], '2010-05-22 13:27:00');
        $this->assertEqual($entry['Aircon']['end_time'], '2010-05-22 13:27:00');
        $this->assertEqual($this->Aircons->redirectUrl, array('action' => 'add'));
    }

    function testViewGeneral() {
        $this->Aircons->data = array();
        $this->Aircons->beforeFilter();
        $this->Aircons->general();
        $viewVars = $this->Aircons->viewVars;
        $this->assertTrue(!empty($viewVars['aircons']));
        $this->assertTrue(is_array($viewVars['aircons']));
    }

}
?>
