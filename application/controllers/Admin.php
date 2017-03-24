<?php
class Admin extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Management';

		$this->load->view('header', $data);
		$this->load->view('admin/navigator');
		$this->load->view('admin/article');
		$this->load->view('footer');
	}
}
?>
