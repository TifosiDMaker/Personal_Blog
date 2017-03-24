<?php
class Tifosi_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}

	public function set_post()
	{
		static $id = 0;
		$id++;

}
?>
