<?php
class Admin extends CI_Controller {

	public function index()
	{
		$this->load->helper('form');
		
		$data['title'] = 'Management';

		$this->load->view('header', $data);
		$this->load->view('admin/navigator');
		$this->load->view('admin/write_article');
		$this->load->view('footer');
	}
}
?>
