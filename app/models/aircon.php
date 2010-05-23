<?php
class Aircon extends AppModel {
	var $name = 'Aircon';
	var $displayField = 'id';
	
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		)
	);
}
?>
