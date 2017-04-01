<?php
	class Admin_driver extends CI_Driver_Library
	{
		public function session_vali ()
		{
			if (array_key_exists('id', $_SESSION))
			{
				if ($_SESSION['id'] == 2)
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return 0;
			}
		}
	}
?>

