<?php
class Index extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('tifosi_model');
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->driver('admin_driver');
	}

	public function index($page = 1)
	{
		$data['title'] = 'Tifosi\'s Blog';
		$data['article'] = $this->tifosi_model->article_query(FALSE, $page);
		$data['category'] = $this->tifosi_model->term_query(2);
		$data['tag'] = $this->tifosi_model->term_query(1);
		$data['page'] = $page;

		$this->load->view('header', $data);

		if ($this->admin_driver->session_exist())
		{
			$this->load->view('user_header');
		}
		else
		{
			$this->load->view('visitor_header');
		}

		$this->load->view('index');
		$this->load->view('index_sidebar');
		$this->load->view('footer');
	}

	public function article($id)
	{
		$row = $this->tifosi_model->article_query($id);

		$data['title'] = $row->post_title;
		$data['content'] = $row->post_content;
		$data['post_time'] = $row->post_date;
		$data['id'] = $row->id;
		$data['category'] = $this->tifosi_model->term_query(2);
		$data['tag'] = $this->tifosi_model->term_query(1);
		$data['comments'] = $this->tifosi_model->comment_query($id);

		$this->load->view('header', $data);

		if ($this->admin_driver->session_exist())
		{
			$this->load->view('user_header');
			$this->load->view('article');
			$this->load->view('view_comments');
			$this->load->view('comment');
		}
		else
		{
			$this->load->view('visitor_header');
			$this->load->view('article');
			$this->load->view('view_comments');
			$this->load->view('comment_decline');
		}

		$this->load->view('index_sidebar');
		$this->load->view('footer');
	}

	public function comment()
	{
		$this->load->library('user_agent');

		$this->tifosi_model->comment();

		redirect($this->agent->referrer());
	}
}
?>
