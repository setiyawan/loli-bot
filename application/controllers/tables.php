<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class Tables extends C_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->is_logged();
    }

    public function index()
    {
    	$this->load->view('header');
    	$this->load->view('inc_data-01');
    	$this->load->view('footer');
    }
}

?>