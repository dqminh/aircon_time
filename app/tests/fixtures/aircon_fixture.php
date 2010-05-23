<?php
/* Aircon Fixture generated on: 2010-05-22 12:05:32 : 1274503532 */
class AirconFixture extends CakeTestFixture {
	var $name = 'Aircon';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'start_time' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'end_time' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'start_time' => '2010-05-22 12:45:32',
			'end_time' => '2010-05-22 16:45:32',
			'user_id' => 1,
			'created' => '2010-05-22 12:45:32',
			'modified' => '2010-05-22 12:45:32'
		),
        array(
            'id' => 2,
            'start_time' => '2010-05-22 13:45:32',
            'end_time' => '2010-05-22 14:45:32',
            'user_id' => 2,
            'created' => '2010-05-22 19:45:32',
            'modified' => '2010-05-22 19:45:32'
        ),
        array(
			'id' => 3,
			'start_time' => '2010-05-22 13:45:32',
			'end_time' => '2010-05-22 16:45:32',
			'user_id' => 3,
			'created' => '2010-05-22 12:45:32',
			'modified' => '2010-05-22 12:45:32'
        ),
        array(
			'id' => 4,
			'start_time' => '2010-05-22 15:45:32',
			'end_time' => '2010-05-22 16:45:32',
			'user_id' => 2,
			'created' => '2010-05-22 12:45:32',
			'modified' => '2010-05-22 12:45:32'
        ),
        array(
			'id' => 5,
			'start_time' => '2010-05-22 21:45:32',
			'end_time' => '2010-05-23 02:45:32',
			'user_id' => 2,
			'created' => '2010-05-22 12:45:32',
			'modified' => '2010-05-22 12:45:32'
        ),
        array(
			'id' => 6,
			'start_time' => '2010-05-23 15:45:32',
			'end_time' => '2010-05-23 16:45:32',
			'user_id' => 3,
			'created' => '2010-05-22 12:45:32',
			'modified' => '2010-05-22 12:45:32'
        ),
        array(
			'id' => 7,
			'start_time' => '2010-06-02 15:45:32',
			'end_time' => '2010-06-02 16:45:32',
			'user_id' => 3,
			'created' => '2010-05-22 12:45:32',
			'modified' => '2010-05-22 12:45:32'
        )
	);
}
?>
