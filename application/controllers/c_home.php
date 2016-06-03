<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_home extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        define('model', 'm_dashboard');
    }

    public function index()
    {
    	$username = $this->input->post('idakun');
        $this->load->model(model);
        $a_data = $this->{model}->dashboard($username);
        echo json_encode($a_data);
    }
}