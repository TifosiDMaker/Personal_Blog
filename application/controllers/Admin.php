<?php
class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('tifosi_model');
		$this->load->library(array('user_agent', 'session', 'pagination'));
		$this->load->helper(array('form', 'url'));
		$this->load->driver('admin_driver');
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

	public function write_article()
	{
		$this->load->library('form_validation');
		
		$data['title'] = 'Management';
		$data['term'] = $this->tifosi_model->term_query(2);

		$this->form_validation->set_rules('articleTitle', '标题', 'required');

		if ($this->admin_driver->session_vali())
		{
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('header', $data);
				$this->load->view('user_header');
				$this->load->view('admin/admin_sidebar');
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

				$this->load->view('header', $data);
				$this->load->view('user_header');
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

	public function loginsuccess()
	{
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

	public function terms($term)
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', '名称', 'required');

		$data['terms'] = $this->tifosi_model->term_query($term);
		$data['term'] = $term;

		if ($term == 2)
		{
			$data['header'] = '分类';
			$data['title'] = '分类';
		}
		elseif ($term == 1)
		{
			$data['header'] = '标签';
			$data['title'] = '标签';
		}

		if ($this->admin_driver->session_vali())
		{
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('header', $data);
				$this->load->view('admin/confirm_box');
				$this->load->view('user_header');
				$this->load->view('admin/admin_sidebar');
				$this->load->view('admin/terms');
				$this->load->view('footer');
			}
			else
			{
				$this->tifosi_model->term($this->input->post('name'), $this->input->post('term'));

				redirect($this->agent->referrer());
			}
		}
	}

	public function delete_term($term_id)
	{
		$this->tifosi_model->delete_term($term_id);

		redirect($this->agent->referrer());
	}
	
	public function edit_term()
	{
		$term_id = $this->input->post('term_id');
		$term_name = $this->input->post('term_name');

		$this->tifosi_model->edit_term($term_id, $term_name);

		redirect($this->agent->referrer());
	}

	public function all_articles($page = 0)
	{
		$config['base_url'] = base_url().'index.php?/admin/all_articles/';
		$config['total_rows'] = $this->tifosi_model->entry_count('posts');
		$config['first_url'] = base_url().'index.php?/admin/all_articles/1';
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;

		$this->pagination->initialize($config);

		$data['title'] = 'All article';
		$data['article'] = $this->tifosi_model->article_query(FALSE, $page);
		$data['links'] = $this->pagination->create_links();

		$this->load->view('header', $data);
		$this->load->view('user_header');
		$this->load->view('admin/admin_sidebar');
		$this->load->view('admin/all_articles');
		$this->load->view('footer');
	}
}
?>
