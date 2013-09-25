<?php
class ThreadController extends AppController
{
	public function index()
	{
		$user = Param::get('us');
		$threads = Thread::getAll();
	
		$adapter = new \Pagerfanta\Adapter\ArrayAdapter($threads);
        $paginator = new \Pagerfanta\Pagerfanta($adapter);
		
        $paginator->setMaxPerPage(5);
        $paginator->setCurrentPage(Param::get('page', 1));
		        $threads = Thread::objectToarray($paginator);

        $view = new \Pagerfanta\View\DefaultView();
        $options = array('proximity' => 3, 'url' => 'card/all');
        $html = $view->render($paginator, 'routeGenerator', $options);
		
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
		$account->username = Param::get('username');
		$account->password = Param::get('password');		
		$account->confirm_password = Param::get('confirm_password');
		
			switch($page){
				case 'reg_form':
					break;
				case 'reg_complete':		
						try {
							$reg->register($account);	
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
