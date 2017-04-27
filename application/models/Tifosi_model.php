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
		$this->db->where('term_name', $name);
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
			'term_name' => $name,
			'term_group' => $group
		);

		return $this->db->insert('terms', $data);
	}			

	public function term_query($term)
	{
		$query = $this->db->get_where('terms', array('term_group' => $term));

		return $query->result();
	}

	public function article_query($id = FALSE, $page = 1, $term = 0)
	{
		if ($id === FALSE)
		{
			$this->db->select('*');
			$this->db->from('posts');
			
			if ($term)
			{
				if (is_numeric($term))
				{
					$this->db->join('relationship', 'relationship.article_id = posts.id');
					$this->db->where('term_id', $term);
				}
				else
				{	
					$this->db->where($term);
				}
			}
			else
			{
				$this->db->where('post_status', 'public');
			}

			$this->db->order_by('post_date', 'DESC');
			$this->db->limit(10, ($page - 1) * 10);
			
			$query = $this->db->get();
			return $query->result();
		}
		else
		{
			$query = $this->db->get_where('posts', array('id' => $id));

			return $query->row();
		}
	}

	public function get_term($aid, $tid)
	{
		$this->db->select('*');
		$this->db->from('relationship');
		$this->db->join('terms', 'terms.term_id = relationship.term_id');
		$this->db->where('article_id', $aid);
		if ($tid == 1)
		{
			$this->db->where('term_group', $tid);
			$query = $this->db->get();

			return $query->result();
		}
		elseif ($tid == 2)
		{
			$this->db->where('term_group', $tid);
			$query = $this->db->get();

			return $query->row();
		}
	}

	public function comment()
	{
		$data = array(
			'comment' => $this->input->post('comment'),
			'post_id' => $this->input->post('id'),
			'user' => $_SESSION['username']
			);

		return $this->db->insert('comments', $data);
	}

	public function comment_query($id)
	{
		$this->db->where('post_id', $id);
		$this->db->order_by('id', 'DESC');

		$query = $this->db->get('comments');

		return $query->result();
	}

	public function entry_count($table, $where = 0)
	{
		if ($where)
		{
			$this->db->from($table);
			$this->db->where($where);

			return $this->db->count_all_results();
		}
		else
		{
			return $this->db->count_all($table);
		}
	}

	public function delete_term($term_id)
	{
		$tables = array('terms', 'relationship');
		$this->db->where('term_id', $term_id);
		$this->db->delete($tables);
	}

	public function edit_term($term_id, $term_name)
	{
		$data['term_name'] = $term_name;

		$this->db->where('term_id', $term_id);	

		$this->db->update('terms', $data);
	}
}
?>
