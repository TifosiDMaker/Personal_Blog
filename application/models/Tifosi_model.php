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

	public function get_user()
	{
		$query = $this->db->get('user');

		return $qurey->result();
	}
}
?>
