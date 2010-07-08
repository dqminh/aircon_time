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
            '1' => array('single' => 60, 'double' => 60, 'triple' => 120),
            '2' => array('single' => 300, 'double' => 0, 'triple' => 120),
            '3' => array('single' => 120, 'double' => 60, 'triple' => 120)
        ); 
        $this->assertEqual($output, $expected);
    }

    function testGenerateReport1() {
        $result = array(
            '0' => array(
                'User' => array('id' => 1, 'name' => 'a'),
                'Aircon' => array(
                    '0' => array(
                        'id' => 1, 
                        'start_time' => '2010-05-22 12:30:00',
                        'end_time' => '2010-05-22 14:30:00',
                        'user_id' => 1
                    )
                )
            )
        );
        $output = $this->User->generateReport($result);
        $expected = array(
            '1' => array('single' => 120, 'double' => 0, 'triple' => 0),
            '2' => array('single' => 0, 'double' => 0, 'triple' => 0),
            '3' => array('single' => 0, 'double' => 0, 'triple' => 0)
        );
        $this->assertEqual($output, $expected);
        
    }

    function testGenerateReport2() {
        $result = array(
            '0' => array(
                'User' => array('id' => 1, 'name' => 'a'),
                'Aircon' => array(
                    '0' => array(
                        'id' => 1,
                        'start_time' =>'2010-05-22 10:30:00',
                        'end_time' => '2010-05-22 11:30:00',
                        'user_id' => 1
                    ),
                    '1' => array(
                        'id' => 4,
                        'start_time' =>'2010-05-23 00:30:00',
                        'end_time' => '2010-05-23 06:30:00',
                        'user_id' => 1
                    ),
                    '2' => array( 
                        'id' => 7,
                        'start_time' =>'2010-05-24 00:00:00',
                        'end_time' => '2010-05-24 06:30:00',
                        'user_id' => 1
                    ),
                    '3' => array(
                        'id' => 10,
                        'start_time' =>'2010-05-24 23:00:00',
                        'end_time' => '2010-05-25 00:00:00',
                        'user_id' => 1
                    ),
                    '4' => array(
                        'id' => 11,
                        'start_time' =>'2010-05-25 10:30:00',
                        'end_time' => '2010-05-25 11:30:00',
                        'user_id' => 1
                    ),
                )
            ),
            '1' => array(
                'User' => array('id' => 2, 'name' => 'b'),
                'Aircon' => array(
                    '0' => array(
                        'id' => 11,
                        'start_time' =>'2010-05-22 09:30:00',
                        'end_time' => '2010-05-22 13:30:00',
                        'user_id' => 2
                    ),
                    '1' => array(
                        'id' => 1,
                        'start_time' =>'2010-05-23 00:00:00',
                        'end_time' => '2010-05-23 09:30:00',
                        'user_id' => 2
                    ),
                    '2' => array(
                        'id' => 1,
                        'start_time' =>'2010-05-24 00:00:00',
                        'end_time' => '2010-05-24 09:30:00',
                        'user_id' => 2
                    ),
                )
            ),
            '3' => array(
                'User' => array('id' => 3, 'name' => 'c'),
                'Aircon' => array(
                    '0' => array(
                        'id' => 1,
                        'start_time' =>'2010-05-22 22:30:00',
                        'end_time' => '2010-05-22 23:30:00',
                        'user_id' => 3
                    ),
                    '1' => array(
                        'id' => 1,
                        'start_time' =>'2010-05-23 20:30:00',
                        'end_time' => '2010-05-24 00:00:00',
                        'user_id' => 3
                    ),
                    '2' => array(
                        'id' => 1,
                        'start_time' =>'2010-05-24 21:30:00',
                        'end_time' => '2010-05-25 00:00:00',
                        'user_id' => 3
                    ),
                )
            )
        );

        $output = $this->User->generateReport($result);
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
