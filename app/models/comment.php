<?php
class Comment extends AppModel
{
	public $validation = array(
		'username' => array(
				'length' => array(
					'validate_between', 4, 16,
			),
		),
		'body' => array(
			'length' => array(
				'validate_between', 1, 200,
			),
		),
		'password' => array(
			'length' => array(
				'validate_between', 4, 16,
			),
		)
		
	);
}
?>