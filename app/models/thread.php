<?php
class Thread extends AppModel
{
	public $validation = array(
		'title' => array(
			'length' => array(
				'validate_between', 1, 30,
			),
		),
	);

	public static function get($id)
	{
		$db = DB::conn();
		$row = $db->row('SELECT * FROM thread WHERE id = ?', array($id));
		return new self($row);
	}
	
	public static function getAll()
	{
		$threads = array();
		
		$db = DB::conn();
		$rows = $db->rows('SELECT * FROM thread');
		
		foreach ($rows as $row){
			$threads[] = new Thread($row);
		}
		return $threads;
	}
	
	public function getComments()
	{
		$comments = array();
		$db = DB::conn();
		$rows = $db->rows(
			'SELECT * FROM comment WHERE thread_id = ? ORDER BY created ASC',
			array($this->id)
		);
		foreach ($rows as $row) {
			$comments[] = new Comment($row);
		}
		return $comments;
	}
	
	public function write(Comment $comment)
	{
		if (!$comment->validate()) {
			throw new ValidationException('invalid comment');
		}
		$db = DB::conn();
		$db->query(
			'INSERT INTO comment SET thread_id = ?, username = ?, body = ?, created = NOW()',
			array($this->id, $comment->username, $comment->body)
		);
	}
	
	public function create(Comment $comment)
	{
		$this->validate();
		$comment->validate();
		if ($this->hasError() || $comment->hasError()) {
			throw new ValidationException('invalid thread or comment');
		}
		
		$db = DB::conn();
		$db->begin();
		
		$db->query('INSERT INTO thread SET title = ?, created = NOW(), username = ?', array($this->title, $comment->username));
		$this->id = $db->lastInsertId();
		
		// write first comment at the same time
		$this->write($comment);
		$db->commit();
	}
	
	public static function login($username, $password){
		
		//echo $username, $password;
		
		$login = "";
		$db = DB::conn();
		$check = $db->query("SELECT * FROM user WHERE user_name = ?  AND password = ? ", array($username, $password));
			
		if($db->rowCount($check) == 1){
			$login=url('thread/index', array('us'=>$username));
			//print "success";
			return $login;
		}
		
	}
	
	public function register(Comment $newUser, Comment $newPass){
		
		if (!$newUser->validate()) {
			throw new ValidationException('invalid comment');
		}

		$n = $newUser->username;
		$pw = $newPass->password;
		/*
			$db = DB::conn();
			$addUser = $db->query("INSERT into user SET user_name = '$n', password = '$pw'");
		*/
	}
	
	public static function validatePassword($pass, $confirm_pass)
	{
		if($pass == $confirm_pass)
			return $rslt=true;
	}
}

class ValidationException extends AppException
{}
?>