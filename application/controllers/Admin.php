<?php
class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('tifosi_model');
	}

	public function index()
	{
		$this->load->helper(array('form', 'url'));

		$data['title'] = 'Login';

		$this->load->view('header', $data);
		$this->load->view('admin/login');
		$this->load->view('footer');
	}

	public function signup()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$data['title'] = 'Signup';
		//$data['table'] = $this->tifosi_model->get_user();

		$this->form_validation->set_rules('username', '用户名', 'required|min_length[3]|max_length[32]|is_unique[users.username]',
			array(
				'required' => '%s为必填字段',
				'min_length' => '%s的最小长度不得小于三个字符',
				'is_unique' => '该用户名已被注册'
			)
		);
		$this->form_validation->set_rules('password', '密码', 'required|min_length[8]|max_length[32]',
			array(
				'required' => '%s为必填字段',
				'min_length' => '%s的最小长度不得小于八个字符'
			)
		);
		$this->form_validation->set_rules('confirm', '确认密码', 'required|matches[password]',
			array(
				'required' => '%s为必填字段',
				'matches' => '两次输入的密码不同'
			)
		);

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header', $data);
			$this->load->view('admin/signup');
			$this->load->view('footer');
		}
		else
		{
			$this->tifosi_model->signup();
			
			$this->load->view('header', $data);
			$this->load->view('admin/signupsuccess');
			$this->load->view('footer');
		}
	}

	public function write()
	{
		$this->load->helper('form');
		
		$data['title'] = 'Management';

		$this->load->view('header', $data);
		$this->load->view('admin/navigator');
		$this->load->view('admin/write_article');
		$this->load->view('footer');
	}

	public function signupsuccess()
	{
		$this->load->helper('url');

		$data['title'] = 'Success';

		$this->load->view('header', $data);
		$this->load->view('admin/signupsuccess');
		$this->load->view('footer');
	}
}
?>
