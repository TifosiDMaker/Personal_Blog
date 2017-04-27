<?php
class Index extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('tifosi_model');
		$this->load->library(array('session', 'pagination'));
		$this->load->helper(array('form', 'url'));
		$this->load->driver('admin_driver');
	}

	public function index($page = 0, $term = 0)
	{

		if ($term)
		{
			$config['base_url'] = base_url().'index.php?/'."/$term/";
			$config['total_rows'] = $this->tifosi_model->entry_count('relationship', array('term_id' => $term));
			$config['first_url'] = base_url().'index.php?/'."/$term/1";
			$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 1;
		}
		else
		{
			$config['base_url'] = base_url().'index.php?/page/';
			$config['total_rows'] = $this->tifosi_model->entry_count('posts', array('post_status' => 'public'));
			$config['first_url'] = base_url().'index.php?/page/1';
			$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 1;
		}

		$this->pagination->initialize($config);

		$data['title'] = 'Tifosi\'s Blog';
		$data['article'] = $this->tifosi_model->article_query(FALSE, $page, $term);
		$data['category'] = $this->tifosi_model->term_query(2);
		$data['tag'] = $this->tifosi_model->term_query(1);
		$data['page'] = $page;
		$data['links'] = $this->pagination->create_links();

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

	public function login()
	{
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
	public function logout()
	{
		session_destroy();

		$data['title'] = 'Logout';

		$this->load->view('header', $data);
		$this->load->view('admin/logout');
		$this->load->view('footer');
	}
	public function signup()
	{
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
}
?>
