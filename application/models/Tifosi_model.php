<?php
class Tifosi_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
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
		$data = array(
			'post_title' => $this->input->post('articleTitle'),
			'post_content' => $this->input->post('article'),
			'post_status' => $this->input->post('status')
		);

		return $this->db->insert('posts', $data);
	}

	public function id_query($name, $column)
	{
		$this->db->where('name', $name);
		$this->db->where('term_group', $column);

		$query = $this->db->get('terms');
		$row = $query->row();

		if (isset($row))
		{
			return $row->term_id;
		}
		else
		{
			return 0;
		}
	}

	public function sqlit_tag()
	{
		return $tags = explode(',', $this->input->post('tags'));
	}

	public function relation($name)
	{
		$query = $this->db->get_where('posts', array('post_title' => $this->input->post('articleTitle')));
		$row = $query->row();
		
		if (isset($row))
		{
			$id = $row->id;
		}
		else
		{
			$id = 1000;
		}
		
		$data = array(
			'article_id' => $id,
			'term_id' => $name
		);

		return $this->db->insert('relationship', $data);
	}

	public function term($name, $group)
	{
		$data = array(
			'name' => $name,
			'term_group' => $group
		);

		return $this->db->insert('terms', $data);
	}			
}
?>
