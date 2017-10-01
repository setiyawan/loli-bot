<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_city extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        define('model', 'm_daerah');
    }

    public function index()
    {
        $this->load->model(model);
        $a_data = $this->{model}->getall();
        echo json_encode($a_data);
    }

    public function topList()
    {
        $count = $this->input->get('count');
        $this->load->model(model);
        $a_data = $this->{model}->topList($count);
        echo json_encode($a_data);
    }
}