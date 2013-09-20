<?php
class ThreadController extends AppController
{
	public function index()
	{
		$threads = Thread::getAll();
		
		$this->set(get_defined_vars());
		
	}
	
	public function view()
	{
		$thread = Thread::get(Param::get('thread_id'));
		$comments = $thread->getComments();
		$this->set(get_defined_vars());
	}
	
	public function write()
	{
		$thread = Thread::get(Param::get('thread_id'));
		$comment = new Comment;
		$page = Param::get('page_next');
		
		switch ($page) {
		case 'write_end':
			$comment->username = Param::get('username');
			$comment->body = Param::get('body');
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
		
		switch ($page) {
			case 'create':
				break;
			case 'create_end':
				$thread->title = Param::get('title');
				$comment->username = Param::get('username');
				$comment->body = Param::get('body');
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
		
		
			switch($page){
				case 'reg_form':
					break;
				case 'reg_complete':
						$account->username = Param::get('username');
						$account->password = Param::get('password');	
						$account->confirm_password = Param::get('confirm_password');
						try {
							$reg->register($account,$account,$account);
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
