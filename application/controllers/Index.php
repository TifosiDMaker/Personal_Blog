<?php
class Index extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('tifosi_model');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->driver('admin_driver');
	}

	public function index($page = 1)
	{
		$this->load->helper('url');

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

		$this->load->view('index', $data);
		$this->load->view('index_sidebar');
		$this->load->view('footer');
	}
}
?>
