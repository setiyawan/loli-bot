<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class Home extends C_controller
{
    public function __construct()
    {
        parent::__construct();
        define('model', 'm_dashboard');
        $this->is_logged();
    }

    public function index()
    {
        $this->is_logged();
        $this->load->model(model);
        $a_data = $this->{model}->datacount();
        
        if(!empty($data)) {
            $a_data['message'] = $data['message'];
            $a_data['code'] = $data['code'];
        }
        else {
            $a_data['message'] = "";
        }
        
    	$this->load->view('header');
    	$this->load->view('home', $a_data);
    	$this->load->view('footer');
    }
}

?>