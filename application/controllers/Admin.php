<?php
class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('tifosi_model');
		$this->load->library('session');
	}

	public function login()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$data['title'] = 'Login';

		$this->form_validation->set_rules('username', '用户名', 'required',
			array('required' => '%s为必填字段')
			);
		$this->form_validation->set_rules('password', '密码', 'required',
			array('required' => '%s为必填字段')
			);

		if (array_key_exists('id', $_SESSION))
		{
			$this->load->view('login_header', $data);
			$this->load->view('welcome.php');
			$this->load->view('footer.php');
		}
		else
		{
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('header', $data);
				$this->load->view('admin/login');
				$this->load->view('footer');
			}
			else
			{
				if ($this->tifosi_model->user_query())
				{
					$this->session->set_userdata($this->tifosi_model->user_query());
					
					$this->load->view('header', $data);
					$this->load->view('admin/signupsuccess');
					$this->load->view('footer');
				}
				else
				{
					$data['title'] = 'Failed';
				
					$this->load->view('header', $data);
					$this->load->view('admin/loginfailed');
					$this->load->view('footer');
				}
			}
		}
	}

	public function signup()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$data['title'] = 'Signup';

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

			$data['title'] = 'Signup success';
			
			$this->load->view('header', $data);
			$this->load->view('admin/signupsuccess');
			$this->load->view('footer');
		}
	}

	public function write_article()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$data['title'] = 'Management';

		$this->form_validation->set_rules('articleTitle', '标题', 'required');

		if (array_key_exists('id', $_SESSION))
		{
			if ($_SESSION['id'] == 2)
			{
				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('login_header', $data);
					$this->load->view('admin/navigator');
					$this->load->view('admin/write_article');
					$this->load->view('footer');
				}
				else
				{
					$this->tifosi_model->write_article();

					$tags = explode(',', $this->input->post('tags'));

					foreach ($tags as $tag)
					{
						if (!$this->tifosi_model->id_query($tag, 1))
						{
							$this->tifosi_model->term($tag, 1);
						}
						$this->tifosi_model->relation($this->tifosi_model->id_query($tag, 1));
					}

					$this->tifosi_model->relation($this->tifosi_model->id_query($this->input->post('category'), 2));

					$data['title'] = 'Success';

					$this->load->view('login_header', $data);
					$this->load->view('success');
					$this->load->view('footer');
				}

			}
			else
			{
				$this->load->view('header', $data);
				$this->load->view('admin/no_permission');
				$this->load->view('footer');
			}
		}
		else
		{
				$this->load->view('header', $data);
				$this->load->view('admin/no_permission');
				$this->load->view('footer');
		}
	}

	public function signupsuccess()
	{
		$this->load->helper('url');

		$data['title'] = 'Success';

		$this->load->view('header', $data);
		$this->load->view('admin/signupsuccess');
		$this->load->view('footer');
	}

	public function logout()
	{
		session_destroy();

		$data['title'] = 'Logout';

		$this->load->view('header', $data);
		$this->load->view('admin/logout');
		$this->load->view('footer');
	}
}
?>
