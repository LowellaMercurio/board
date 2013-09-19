<?php
class RegisterController extends AppController {
	public function index(){
		
		$username = Param::get('username');
		$password = Param::get('password');
		$login = Register::login($username, $password);

		$this->set(get_defined_vars());
	}
	
	public function reg_form(){
		
		$page = Param::get('page_next', 'reg_form');
		
			switch($page){
				case 'reg_form':
					break;
				case 'reg_complete':
						$newUser = Param::get('username');
						$newPass = Param::get('password');	
						$confirmPass = Param::get('confirm_password');
						
						try {
							$reg = new Register($newUser, $newPass, $confirmPass);
						} catch (ValidationException $e) {
							$page = 'reg_form';
						}
					break;
				default:
					throw new NotFoundException("{$page} is not found");
					break;
			}

		$this->set(get_defined_vars());
		$this->render($page);
	}
}
?>