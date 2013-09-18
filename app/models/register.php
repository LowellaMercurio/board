<?php 
class Register extends AppModel {

	public static function login($username, $password){
		
		//echo $username, $password;
		
		$login = "";
		$db = DB::conn();
		$check = $db->query("SELECT * FROM user WHERE user_name = '$username'  AND password = '$password' ");
		
				
		if($db->rowCount($check) != 0){
			$login=url('thread/index', array($username));
			//print "success";
		}else{
			$login=url('register/index');
			//print "error";
		}
		return $login;
		
	}
	
}
?>