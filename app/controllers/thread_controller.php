<?php
class ThreadController extends AppController
{
	public function index()
	{
		$threads = Thread::getAll();
		$user = Param::get('us');
		$this->set(get_defined_vars());
		
	}
	
	public function view()
	{
		$thread = Thread::get(Param::get('thread_id'));
		$user = Param::get('us');
		$comments = $thread->getComments();
		$this->set(get_defined_vars());
	}
	
	public function write()
	{
		$thread = Thread::get(Param::get('thread_id'));
		$comment = new Comment;
		$page = Param::get('page_next');
		//$user = Param::get('us');
		$comment->username = Param::get('us');
		$comment->body = Param::get('body');
		
		switch ($page) {
		case 'write':
			break;
		case 'write_end':
			try {
				$thread->write($comment);
			} catch (ValidationException $e) {
				$page = 'write';
			}
			break;
		default:
			throw new NotFoundException("{$page} is not found");
			break;
		}
		$this->set(get_defined_vars());
		$this->render($page);
	}
	
	public function create()
	{
		$thread = new Thread;
		$comment = new Comment;
		$page = Param::get('page_next', 'create');
		
		$thread->title = Param::get('title'); 
		$comment->username = Param::get('us'); //Get the current login user
		$comment->body = Param::get('body');
		
		switch ($page) {
			case 'create':
				break;
			case 'create_end':
				try {
					$thread->create($comment);
				} catch (ValidationException $e) {
					$page = 'create';
				}
				break;
			default:
					throw new NotFoundException("{$page} is not found");
					break;
			}
			$this->set(get_defined_vars());
			$this->render($page);
	}
	public function login(){
		
		$username = Param::get('username');
		$password = Param::get('password');
		$login = Thread::login($username, $password);

		$this->set(get_defined_vars());
	}
	
	public function reg_form(){
		
		$page = Param::get('page_next', 'reg_form');
		$account = new Comment;
		$reg = new Thread;
		$rslt = new Thread;
		$account->username = Param::get('username');
		$account->password = Param::get('password');		
		$account->confirm_password = Param::get('confirm_password');
		
			switch($page){
				case 'reg_form':
					break;
				case 'reg_complete':
						
						try {
							$rslt->validatePassword($account->password, $account->confirm_password);
								if ($rslt->validatePassword = true)
									$reg->register($account,$account);
								else
									$page = 'reg_form';
							
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
