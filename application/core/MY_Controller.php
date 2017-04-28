<?php
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->driver('admin_driver');
        $this->load->library('session');
        $this->load->helper('url');

        if (!$this->admin_driver->sessionVali()) {
            $data['title'] = 'No permission';

            $this->load->view('header', $data);
            $this->load->view('visitor_header');
            $this->load->view('admin/no_permission');
            $this->load->view('footer');
            $this->output->_display();
            exit();
        }
    }
}
?>
