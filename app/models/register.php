<?php 
class Register extends AppModel {

	public static function login($username, $password){
		
		//echo $username, $password;
		
		$login = "";
		$db = DB::conn();
		$check = $db->query("SELECT * FROM user WHERE user_name = '$username'  AND password = '$password' ");
		
				
		if($db->rowCount($check) != 0){
			$login=url('thread/index', array('us'=>$username));
			//print "success";
		}
		return $login;
		
	}
	
	public function register($newUser, $newPass, $confirmPass){
		
		if (($newPass != $confirmPass) || (empty($newPass)) || (empty($confirmPass)) || (empty($newUser))){
			
		}else{
			$db = DB::conn();
			$addUser = $db->query("INSERT into user SET user_name = '$newUser', password = '$newPass'");
		}
	}
	
}
?>