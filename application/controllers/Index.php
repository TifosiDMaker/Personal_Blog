<?php
class Index extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('tifosi_model');
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->helper('url');

		$this->load->view('header');
		$this->load->view('index');
		$this->load->view('footer');
	}
}
?>
