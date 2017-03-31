<?php
class Tifosi_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function set_post()
	{
		static $post_id = 0;
		$post_id++;
	}

	public function signup()
	{
		$data = array(
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'permission' => 1,
		);

		return $this->db->insert('users', $data);
	}

	public function user_query()
	{
		$query = $this->db->get_where('users', array('username' => $this->input->post('username')));
		$row = $query->row();
		
		if (isset($row))
		{
			if ($row->password == md5($this->input->post('password')))
			{
				return array(
					'username' => $this->input->post('username'),
					'id' => $row->permission
				);
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}

	public function write_article()
	{
		$process = $this->input->post('tags');
		$process = explode(',', $process);
		$tags = array();

		$data = array(
			'post_title' => $this->input->post('articleTitle'),
			'post_content' => $this->input->post('article'),
			'post_status' => $this->input->post('status')
		);

		return $this->db->insert('posts', $data);

		foreach ($process as $tag) 
		{
			array_push($tags, ltrim($tag));
		}

		foreach ($tags as $tag)
		{
			$tag_qurey = $this->db->get_where('terms', array('name' => $tag));
			$row = $tag_query->row();
		}
	}
}
?>
