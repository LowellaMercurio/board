<?php 
class RegisterController extends AppController {
	public function index(){
		
		$username = Param::get('username');
		$password = Param::get('password');
		$login = Register::login($username, $password);
		$this->set(get_defined_vars());
	}
}
?>