<?php
/* User Test cases generated on: 2010-05-22 12:05:10 : 1274503390*/
App::import('Model', 'User');

class UserTestCase extends CakeTestCase {
	var $fixtures = array('app.user', 'app.aircon');

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function endTest() {
		unset($this->User);
		ClassRegistry::flush();
	}

    function testFindUsage() {
        $result = $this->User->find('usage', array(
            'start' => '2010-05-22 12:45:32',
            'end' => '2010-05-24 12:45:32'
            )
        );
        $expected = array(
            'id' => 1,
            'start_time' => '2010-05-22 12:45:32',
            'end_time' => '2010-05-22 16:45:32',
            'user_id' => 1,
            'created' => '2010-05-22 12:45:32',
            'modified' => '2010-05-22 12:45:32'
        );
        $this->assertEqual($result[0]['Aircon']['0'], $expected);
    }

    function testGenerateReport() {
        $result = $this->User->find('usage', array(
            'start' => '2010-05-22 12:45:32',
            'end' => '2010-06-03 12:45:32'
            )
        );
        $output = $this->User->generateReport($result);
        $expected = array(
            '1' => array('single' => 1, 'double' => 1, 'triple' => 2),
            '2' => array('single' => 5, 'double' => 0, 'triple' => 2),
            '3' => array('single' => 2, 'double' => 1, 'triple' => 2)
        ); 
        $this->assertEqual($output, $expected);
    }

    function testGetCommonTime() {
        $r1 = $this->User->getCommonTime(1,5,2,4);
        $this->assertEqual($r1, 2);
        $r2 = $this->User->getCommonTime(1,3,2,4);
        $this->assertEqual($r2, 1);
        $r3 = $this->User->getCommonTime(1,2,3,4);
        $this->assertEqual($r3, 0);
        $r4 = $this->User->getCommonTime(1,3,0,5);
        $this->assertEqual($r4, 2);
    }
}
?>
