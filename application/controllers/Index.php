<?php
class Index extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('tifosi_model');
		$this->load->library('session');
		$this->load->helper('form');
	}

	public function index()
	{
		$this->load->helper('url');

		$data['title'] = 'Tifosi\'s Blog';
		$data['article'] = $this->tifosi_model->article_query();
		$data['category'] = $this->tifosi_model->term_query(2);
		$data['tag'] = $this->tifosi_model->term_query(1);

		$this->load->view('header', $data);
		$this->load->view('index');
		$this->load->view('footer');
	}
}
?>
